# This code is inspired from
# https://stackoverflow.com/questions/62418539/how-to-obtain-stock-market-company-sector-from-ticker-or-company-name-in-python

import sys
import mysql.connector
from lxml.html import parse
import urllib
from urllib.request import Request, urlopen
#import MySQLdb
#import pandas as pd
#from IPython.core.display import display, HTML

file_name = sys.argv[0]
sector = sys.argv[1]

headers = [
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3)" + " "
    "AppleWebKit/537.36 (KHTML, like Gecko)" + " " + "Chrome/35.0.1916.47" +
    " " + "Safari/537.36"
]

url = 'https://www.stockmonitor.com/sector/' + sector + '/'

headers_dict = {'User-Agent': headers[0]}
req = Request(url, headers=headers_dict)

try:
  webpage = urlopen(req)

  tree = parse(webpage)

  mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="BlueDragon!2",
    database="tfm"
  )

  mycursor = mydb.cursor()

  mySql_insert_query = """INSERT INTO company (short_name, full_name, sector, current_price)
                           VALUES """

  count = 0
  for row in tree.xpath("//tbody/tr"):
    # Take only first 10 company names as a sample and create corresponding entries in the TFM DB
    #if (count == 20):
    #  break
    columns = row.findall('td')
    ticker = columns[1].findall('a')[0].text.strip()
    company = columns[2].text.strip()
    price = columns[3].text.strip()

    if (ticker == "AAPL") or (ticker == "BA") or (ticker == "CAT") or (ticker == "CVX") or (ticker == "DIS") or (ticker == "DOW") or (ticker == "GS") \
    or (ticker == "JNJ") or (ticker == "KO") or (ticker == "MMM") or (ticker == "NKE") or (ticker == "PG") or (ticker == "UNH") or (ticker == "VZ") or (ticker == "WMT"):
      mySql_insert_query += " ('" + ticker + "', '" + company + "', '" + sector + "', " + price + ") " 
      count += 1
      break    

  # print("Ticker =", ticker, " Company = ", company, " price = ", price)
    #if (count == 0):
    #  mySql_insert_query += " ('" + ticker + "', '" + company + "', '" + sector + "', " + price + ") "
    #else:
    #  mySql_insert_query += ", ('" + ticker + "', '" + company + "', '" + sector + "', "  + price + ") "
    #count += 1

  # print (mySql_insert_query)
  if (count == 0):
    print ("No companies are found under the sector: ", sector)
  else:
    try:
      mycursor.execute (mySql_insert_query)
      print("Added ", count, " records in 'Company' table of TFM DB")
    except mysql.connector.errors.IntegrityError:
      print("Records could not be added in 'Company' table of TFM DB")
    finally:
      mydb.commit()
      mycursor.close()
      mydb.close()

except urllib.error.HTTPError:
  print("Invalid sector name: ", sector)
  print ("URL '" + url + "': Not found")
