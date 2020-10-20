import os
import ssl
from datetime import datetime
from urllib.request import urlopen, Request
from urllib.parse import urlparse
import socket
import threading
import queue

UA = "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0"
pastebin_user = ['jroosen', 'emf1123', 'paladin316']
TIMEOUT=5

def is_ip(ip):
    try:
        socket.inet_aton(ip)
        return True
    except socket.error:
        return False


def get_urls(user):
    results = os.popen(
        "curl -A '" +
        UA +
        "' -q https://pastebin.com/u/" +
        user +
        " |grep Emotet |grep \"$(date +\'%Y-%m-%d\')\" |awk '{ print $14 }' |cut -d'\"' -f2-2").read()
    results = results.splitlines()
    if(len(results) > 0):
        print(str(len(results)) + " paste found for " + user +
              " on " + str(datetime.date(datetime.now())))
        return results
    else:
        print("No paste found for " + user + " on " +
              str(datetime.date(datetime.now())))
        return []

def process_reply(reply, website):
    if "password" in reply and "rememberme" in reply:
        print("[*] " + website)

def crawl(url):
    while q.qsize() > 0:
        item = q.get()
        try:
            request = Request(item, headers={'User-Agent': UA})
            response = urlopen(request, timeout=TIMEOUT,context=ssl._create_unverified_context())
            b = response.read().decode("utf8")
            process_reply(b, item)
        except Exception as e:
           pass

def parse_url(list_urls):
    if(len(list_urls) > 0):
        a = []
        for url in list_urls:
            url = "https://pastebin.com/raw" + url
            print("Fetching " + url)
            try:
                reply = urlopen(
                    Request(
                        url,
                        headers={
                            'User-Agent': UA}),
                    timeout=5)
                b = parse(reply.read().decode("utf8"))
                if(b is not None):
                    for e in b:
                        a.append(e)
            except Exception as e:
                print(e)
                exit(0)
        return a


def parse(content):
    content = content.splitlines()
    item_list = []
    for item in content:
        if(":" in item and "." in item):
            item = item.split(":")[0]
            if is_ip(item):
                item_list.append("https://" + item + "/wp-login.php")
                item_list.append("http://" + item + "/wp-login.php")
    return item_list

infected_sites = []

for user in pastebin_user:
    array = parse_url(get_urls(user))
    if(array is not None):
        infected_sites = infected_sites + array

mylist = list(dict.fromkeys(infected_sites))
unique = []
for x in mylist:
    unique.append(x)

q = queue.Queue()
for y in unique:
    q.put(y)

for i in range(25):
    threading.Thread(target=crawl, args=(q,)).start()
