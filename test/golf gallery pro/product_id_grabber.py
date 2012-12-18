import sys
import os


# Make sure there's a file name
try:
	sys.argv[1]
except: 
	print "You must supply a file name"
	sys.exit(1)
	
	
#define some constants

#string to know we're on the right line
lineStr = "<a href=\"/admin/products/"
#string to know how long we should index out
lineStrPlusId = "<a href=\"/admin/products/113600486"
#string so we know the label
labelStr = "\">"
#string so we know we're at the end of the label
labelEndStr = "</a>"




#grab the file name
filename = sys.argv[1]

#open up the file
f = open(os.getcwd()+"/"+filename, 'r')

#loop over the lines and pull out the ones we want
for line in f:
	if lineStr in line:
		#found the line we want
		#get the start index
		index = line.find(lineStr);
		id = line[index+len(lineStr): index+len(lineStrPlusId)]
		
		#get the label
		indexStart = line.find(labelStr) + len(labelStr)
		indexEnd = line.find(labelEndStr)
		title = line[indexStart:indexEnd]
		
		print title, "\t", id
		#print line
		
	
f.close()