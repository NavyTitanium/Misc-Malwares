from urllib.request import urlopen, Request
from urllib.parse import urlparse
import sys
import os
import threading
import queue
import requests
import time

# List of infected WordPress URLs
filename = "list.txt"
TIMEOUT = 8

# Stop searching after one webshell is found
stop_after_success = True

# Stop searching on a website after x seconds
stop_after = 120

# Performs POST querie(s) to the webshell(s) detected to confirm its presence.
# POST parameter value "e" is expecting to receive gzdeflate(base64encode()) of the PHP command
# POST parameter value "p" is expecting the password
# The detection relies on the fact that providing a wrong password causes HTTP 500
active_detection= True

reason_ok = ['404', '403', '401', '500']
UA = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:79.0) Gecko/20100101 Firefox/79.0'

WP_paths = [
    'wp-content',
    'wp-includes',
    'wp-admin',
    '',
    'wp-includes/fonts',
    'wp-includes/js',
    'wp-content/plugins',
    'wp-includes/customize',
    'wp-includes/images',
    'wp-includes/widgets',
    'wp-admin/css',
    'wp-admin/css/colors',
    'wp-content/uploads',
    'wp-admin/user',
    'wp-admin/js',
    'wp-admin/includes',
    'wp-admin/network']

Webshells = [
    'import.php',
    'database.php',
    'link.php',
    'user.php',
    'licence.php',
    'lang.php',
    'edit.php',
    'image.php',
    'updating.php',
    'export.php',
    'plugin_updater.php',
    'format.php',
    'pluginupdater.php',
    'config.php',
    'core.php',
    'selfsigned.php']

def active_check(website):
    data= {'p':'123456','e': 'command'}
    try:
       response = requests.post(website, data = data,headers={'User-Agent': UA})
       if (response.status_code == 500):
           return True
    except Exception as e:
        return False
        pass

    return False

def process_reply(reply, website):
    if len(reply) ==0:
        if active_detection:
            if(active_check(website)): 
                print("[*Webshell found] " + website)
                return True
        else:
            print("[Webshell found] " + website)
            return True

    return False

def crawl(q):
    while q.qsize() > 0:
        item = q.get()
        if(validate_connection(item[0])):
            item.pop(0)
            start = time.time()
            for paths in item:
                if(time.time()-start < stop_after):

                    request = Request(paths, headers={'User-Agent': UA})
                    try:
                        response = urlopen(request, timeout=TIMEOUT)
                        if (response.getcode() == 200):
                            status=process_reply(response.read().decode("utf8"), paths)
                            if(stop_after_success and status): break
                    except Exception as e:
                        pass

                else: break

def validate_connection(website):
    try:
        urlopen(Request(website, headers={'User-Agent': UA}), timeout=TIMEOUT)
        return True
    except Exception as e:
        error = str(e)
        for code in reason_ok:
            if code in error:
                return True
        return False

def parse_url(url):
    a = []
    url = url.replace("hxxp://", "http://")
    url = url.replace("hxxps://", "https://")
    url = url.replace("[.]", ".")
    o = urlparse(url)
    url_without_query_string = o.scheme + "://" + o.netloc
    url_without_query_string = url_without_query_string.rstrip("/")
    a.append(url_without_query_string)
    full_url = (o.scheme + "://" + o.netloc + o.path).rstrip("/")
    full_url = full_url.split("/")
    full_url.pop(0)
    full_url.pop(0)
    full_url.pop(0)

    if(len(full_url) > 1 and not bool(set(full_url).intersection(WP_paths))):
        full_url.pop()
        u = url_without_query_string
        for p in full_url:
            u = u + "/" + p
            a.append(u)

    return a

def usage(code=0):
    print('Usage: ' + os.path.basename(__file__) + ' list.txt')
    print('The list should contain the infected WordPress URLs')
    exit(code)

if len(sys.argv) != 2:
    usage(1)

filename = sys.argv[1]
urls_list = []
q = queue.Queue()

with open(filename) as f:
    urls_list = []
    for line in f:
        t = []
        t = parse_url(line.strip())
        urls_list.append(t)

paths_generated=[]

for i in range(len(urls_list)):
    urls_list_for_that_site = []
    urls_list_for_that_site.append(urls_list[i][0])
    for paths in WP_paths:
        for webshell in Webshells:
            if len(paths)>1:
                current=urls_list[i][0] + "/" + paths + "/" + webshell
            else:
                current=urls_list[i][0] + "/" + webshell

            if(current not in paths_generated):
	            urls_list_for_that_site.append(current)
        	    paths_generated.append(current)

    mainsite=urls_list[i].pop(0)
    for url in urls_list[i]:
        for webshell in Webshells:
            current=url + "/" + webshell
            if(current not in paths_generated):
                    urls_list_for_that_site.append(current)
                    paths_generated.append(current)

    legitimate_path="/wp-includes/user.php"
    if (mainsite+legitimate_path) in urls_list_for_that_site:
        urls_list_for_that_site.remove(mainsite + "/wp-includes/user.php") 

    q.put(urls_list_for_that_site)

print(str(len(urls_list)) + " websites will be tested with " + str(len(paths_generated)) +  " URLS generated" )
paths_generated=[]

for i in range(35):
    threading.Thread(target=crawl, args=(q,)).start()
