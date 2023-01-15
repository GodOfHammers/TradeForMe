# This code is inspired from
# https://stackoverflow.com/questions/62418539/how-to-obtain-stock-market-company-sector-from-ticker-or-company-name-in-python

import sys
import mysql.connector
import requests
from lxml.html import parse
import urllib
from urllib.request import Request, urlopen
#import MySQLdb
#import pandas as pd
#from IPython.core.display import display, HTML

file_name = sys.argv[0]
company_short_name = sys.argv[1]
sector = sys.argv[2]

#print("In Python file --> received sector=", sector, " company_short_name=", company_short_name, "\n<BR>")

headers = [
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3)" + " "
    "AppleWebKit/537.36 (KHTML, like Gecko)" + " " + "Chrome/35.0.1916.47" +
    " " + "Safari/537.36"
]

url = 'https://www.stockmonitor.com/sector/' + sector + '/'

headers_dict = {'User-Agent': headers[0]}
req = Request(url, headers=headers_dict)
#print("In Python file (before try) --> URL=", url, " company_short_name=", company_short_name, "\n<BR>")

try:
  webpage = urlopen(req)
  #print("In Python file (after URL open) --> received sector=", sector, " company_short_name=", company_short_name, "\n<BR>")
  tree = parse(webpage)

  mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="BlueDragon!2",
    database="tfm"
  )

  found = 0
  company_full_name = ""
  price = 0
  
  for row in tree.xpath("//tbody/tr"):
    columns = row.findall('td') 
    ticker = columns[1].findall('a')[0].text.strip()
    #print (ticker)
    if (ticker == company_short_name):
      company_full_name = columns[2].text.strip()
      price = columns[3].text.strip()
      found = 1
      break

  print("fname=", company_full_name, "&price=", price, "After for loop")

except urllib.error.HTTPError:
  print("fname=", company_full_name, "&price=", price, "&sector=", sector)


