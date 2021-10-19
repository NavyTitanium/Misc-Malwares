import sys
import os
import requests
import urllib3
from bs4 import BeautifulSoup
from termcolor import colored
import threading
import queue

wp_basepath=os.path.join(os.path.dirname(os.path.abspath(__file__)),"WordPress-5.8.1")

if not os.path.isdir(wp_basepath):
    exit("The WordPress source code couldn't be found at " + wp_basepath)

crawlable_dir= {}
UA="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36"
urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

def print_results(folders,files):
    for folder in sorted(folders):
        if "/plugins/" in folder:
            print(colored("[Plugin]",'green'),colored(folder,'cyan'))
        elif "/themes/" in folder:
            print(colored("[Theme]",'green'),colored(folder,'magenta'))
        else:
            print(colored("[Directory]",'yellow'),colored(folder,'blue'))

    for file in sorted(files):
        print(colored("[File]",'yellow'),colored(file,'red'))

def find_anomalies(folders,files,path,level):
    anomalies_files=[]
    anomalies_folders=[]
    for file in files:
        if file not in crawlable_dir[path]:
            anomalies_files.append(path +"/"+file)
    for folder in folders:
        if path+"/"+folder.strip()[:-1] not in crawlable_dir.keys():
            anomalies_folders.append(path +"/"+folder)

    if len(anomalies_folders)>0 or len(anomalies_files)>0:
        print_results(anomalies_folders,anomalies_files)

def parse_page(content):
    folders=[]
    files=[]
    soup = BeautifulSoup(content, 'html.parser')
    for link in soup.find_all('a'):
        file_or_folder=link.get('href')
        if "parent directory" not in link.get_text().lower():
            if "?" not in file_or_folder and ";" not in file_or_folder:
                if "/" in file_or_folder:
                    folders.append(file_or_folder)
                elif ".php" in file_or_folder:
                    files.append(file_or_folder)

    return folders,files

def is_directoy_listing_enable(url):
    try:
        resp=requests.get(url, verify=False,timeout=5, headers={'User-Agent': UA})
        if '<h1>index of' in resp.text.lower() or 'href="?C=D;O=A">' in resp.text.lower():
            return True,resp.text
        return False,""
    except Exception as e:
        print("ERROR: "+str(e))
        return False,""

def subdirectory_depth(level):
    keys=[]
    for key in crawlable_dir:
        if key.count(os.path.sep)==level:
            keys.append(key)
    return keys

def load_files():
    # r=root, d=directories, f = files
    for r, d, f in os.walk(wp_basepath):
        directory=os.path.split(r)[0]
        if directory not in crawlable_dir: crawlable_dir[directory]=[]
        for file in f:
            path=(os.path.join(r, file).split(wp_basepath)[1])
            directory=os.path.split(path)[0]
            if directory not in crawlable_dir: crawlable_dir[directory]=[]
            if ".php" in file and directory != "/":
                crawlable_dir[directory].append(os.path.split(path)[1])

    to_append=[]
    for key in crawlable_dir:
        if "/" in key:
            subfolder=os.path.split(key)[0]
            if subfolder not in crawlable_dir and subfolder !="/" and subfolder not in to_append:
                to_append.append(subfolder)
    for items in to_append:
        crawlable_dir[items]=[]
    return crawlable_dir

def crawl(q,website,level):
    while q.qsize() > 0:
        path = q.get()
        folders=[]
        files=[]
        isEnable,response=is_directoy_listing_enable(website+path)
        if isEnable:
            folders,files=parse_page(response)
            find_anomalies(folders,files,path,level)

def main(website):
    crawlable_dir=load_files()
    nb_items= sum([len(x) for x in crawlable_dir.values()])
    print("[*] "+str(len(crawlable_dir)) + " subdirectories and " +str(nb_items) + " PHP files loaded for comparison")

    # WordPress usually has 4 levels of folder
    # We will use 4 queues to process those paths
    q_lvl1 = queue.Queue()
    q_lvl2 = queue.Queue()
    q_lvl3 = queue.Queue()
    q_lvl4 = queue.Queue()
    [q_lvl1.put(x) for x in subdirectory_depth(1)]
    [q_lvl2.put(x) for x in subdirectory_depth(2)]
    [q_lvl3.put(x) for x in subdirectory_depth(3)]
    [q_lvl4.put(x) for x in subdirectory_depth(4)]

    for i in range(5):
        threading.Thread(target=crawl, args=(q_lvl1,website,1)).start()
        threading.Thread(target=crawl, args=(q_lvl2,website,2)).start()
        threading.Thread(target=crawl, args=(q_lvl3,website,3)).start()
        threading.Thread(target=crawl, args=(q_lvl4,website,4)).start()

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print('Usage: ' + os.path.basename(__file__) + ' http://example.com')
        print('The argument should be the URL of the WordPress site to scan')
        exit(1)

    main(sys.argv[1])
