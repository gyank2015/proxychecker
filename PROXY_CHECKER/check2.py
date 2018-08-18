import os
import Queue
import threading
import urllib2
import random

myfile = open("/Users/mr.Robot/Desktop/PROXY_CHECKER/candidates.txt")
read = myfile.read()
urls = read.split()

response_url = "https://www.google.com/humans.txt"
redirect_output_to_file = "temp.txt"
google_return_value="Google is built by a large team of engineers, designers, researchers, robots, and others in many different sites across the globe. It is updated continuously, and built with more tools and technologies than we can shake a stick at. If you'd like to help us out, see google.com/careers.\n"
l=[]
threads=[]
i=0

#print("check if this is working!")
def CheckProxy(s):
	comm = "curl -s --connect-timeout 1 --proxy " + "http://" + s + " " + response_url
	var = os.popen(comm).read()
	# global i
	# print(var+str(i))
	# i=i+1
	if(var==google_return_value):
		l.append(s)

for u in urls:
	t = threading.Thread(target=CheckProxy,args=(u,))
	t.Daemon=False
	threads.append(t)

for x in threads:
	x.start()

for x in threads:
	x.join()

myfile = open("/Users/mr.Robot/Desktop/PROXY_CHECKER/working_proxies.txt","w")

random.shuffle(l)

for x in l:
	if x!="172.16.114.121:3128":
		myfile.write(x+"\n")

myfile.close()
