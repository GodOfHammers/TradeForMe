# This code is inspired from
# https://stackoverflow.com/questions/62418539/how-to-obtain-stock-market-company-sector-from-ticker-or-company-name-in-python

# Importing necessary libraries
import sys
import mysql.connector
from lxml.html import parse
import urllib
from urllib.request import Request, urlopen

# Setting file name and sector as command line arguments
file_name = sys.argv[0]
sector = sys.argv[1]

# Setting headers for the request
headers = [
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3)" + " "
    "AppleWebKit/537.36 (KHTML, like Gecko)" + " " + "Chrome/35.0.1916.47" +
    " " + "Safari/537.36"
]

# Creating the url for the sector
url = 'https://www.stockmonitor.com/sector/' + sector + '/'

# Creating the header dictionary
headers_dict = {'User-Agent': headers[0]}
req = Request(url, headers=headers_dict)

# Try to open the webpage
try:
  webpage = urlopen(req)

  # Parsing the webpage
  tree = parse(webpage)

  # Connecting to the database
  mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="BlueDragon!2",
    database="tfm"
  )

  # Creating a cursor
  mycursor = mydb.cursor()

  # Creating a template for the SQL insert query
  mySql_insert_query = """INSERT INTO company (short_name, full_name, sector, current_price)
                           VALUES """

  # Initializing a count variable
  count = 0
  # Looping through the rows in the table
  for row in tree.xpath("//tbody/tr"):
    # Take only first 10 company names as a sample and create corresponding entries in the TFM DB
    #if (count == 20):
    #  break
    columns = row.findall('td')
    ticker = columns[1].findall('a')[0].text.strip()
    company = columns[2].text.strip()
    price = columns[3].text.strip()

    # Checking if the ticker belongs to the selected companies
    if (ticker == "AAPL") or (ticker == "BA") or (ticker == "CAT") or (ticker == "CVX") or (ticker == "DIS") or (ticker == "DOW") or (ticker == "GS") \
    or (ticker == "JNJ") or (ticker == "KO") or (ticker == "MMM") or (ticker == "NKE") or (ticker == "PG") or (ticker == "UNH") or (ticker == "VZ") or (ticker == "WMT"):
      # Adding the values to the insert query
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

  # Checking if any companies were found
  if (count == 0):
    print ("No companies are found under the sector: ", sector)
  else:
    try:
      # Executing the insert query
      mycursor.execute (mySql_insert_query)
      print("Added ", count, " records in 'Company' table of TFM DB")
    except mysql.connector.errors.IntegrityError:
      print("Records could not be added in 'Company' table of TFM DB")
    finally:
      # Committing the changes and closing the cursor and connection
      mydb.commit()
      mycursor.close()
      mydb.close()

# Handling exception for invalid sector name
except urllib.error.HTTPError:
  print("Invalid sector name: ", sector)
  print ("URL '" + url + "': Not found")
