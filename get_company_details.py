# This code is inspired from
# https://stackoverflow.com/questions/62418539/how-to-obtain-stock-market-company-sector-from-ticker-or-company-name-in-python

# Import the necessary libraries
import sys
import mysql.connector
import requests
from lxml.html import parse
import urllib
from urllib.request import Request, urlopen

# Get the command line arguments
file_name = sys.argv[0]
company_short_name = sys.argv[1]
sector = sys.argv[2]

# Create a list of headers
headers = [
"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3)" + " "
"AppleWebKit/537.36 (KHTML, like Gecko)" + " " + "Chrome/35.0.1916.47" +
" " + "Safari/537.36"
]

# Create the url for the webpage to be scraped
url = 'https://www.stockmonitor.com/sector/' + sector + '/'

# Create a dictionary of headers
headers_dict = {'User-Agent': headers[0]}
req = Request(url, headers=headers_dict)

try:
    # Open the webpage using the urlopen() function from the urllib library
    req = urllib.request.urlopen(url)
    webpage = req.read()

    # Parse the webpage using the parse() function from the lxml library
    tree = etree.fromstring(webpage)

    # Connect to the MySQL database using the connect() function from the mysql.connector library
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="BlueDragon!2",
        database="tfm"
    )

    # Initialize variables to track whether the company was found and its full name and price
    found = 0
    company_full_name = ""
    price = 0

    # Iterate over each row in the table
    for row in tree.xpath("//tbody/tr"):
        columns = row.findall('td')
        ticker = columns[1].findall('a')[0].text.strip()
        
        # Check if the current row is for the desired company
        if (ticker == company_short_name):
            company_full_name = columns[2].text.strip()
            price = columns[3].text.strip()
            found = 1
            break

    print("fname=", company_full_name, "&price=", price, "After for loop")

# Handle any HTTP errors that may occur
except urllib.error.HTTPError as e:
    print("An error occurred:", e)
    print("fname=", company_full_name, "&price=", price, "&sector=", sector)


