# Import the necessary libraries
import time
import pandas as pd
import mysql.connector
from tabulate import tabulate
from selenium import webdriver
from fetch_tweets import get_tweets
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.support import expected_conditions as EC

def main():

    # initiate a web driver (e.g ChromeDriver)
    driver = webdriver.Chrome()

    # navigate to the login page
    driver.get("http://localhost/tfm/index.html")

    # find the username and password elements and enter the credentials
    username = driver.find_element(By.NAME, "name")
    password = driver.find_element(By.NAME, "password")
    username.send_keys("admin")
    password.send_keys("Idontknow!2")

    # find the login button and click it
    login_button = driver.find_element(By.ID, "submit_1")
    login_button.click()

    # check for successful login
    if "Welcome" in driver.page_source:
        # navigate to the page with the desired list element
        driver.get("http://localhost/tfm/Get_Reliable_Twitteratis.php?name=admin")

        # Finding the web elements
        dropdown = driver.find_element(By.ID, "sectorList")
        list = driver.find_element(By.ID, "companies")
        from_date_field = driver.find_element(By.ID, "fromDate")
        to_date_field = driver.find_element(By.ID, "toDate")

        while True:
            # Clicking on the dropdown and getting the selected option
            dropdown.click()
            dropdown_options = dropdown.find_elements(By.TAG_NAME, "option")
            for option in dropdown_options:
                if option.is_selected():
                    sector = option.text
                    break
                else:
                    sector = "No sector was selected"

            # Clicking on the list of companies and getting the selected option
            list.click()
            list_options = list.find_elements(By.TAG_NAME, "option")
            for option in list_options:
                if option.is_selected():
                    company = option.text
                    break
                else:
                    company = "No company was selected"
            
            # Getting the values of the date fields
            from_date = from_date_field.get_attribute("value")
            to_date = to_date_field.get_attribute("value")
            
            # Function to fetch tweets
            get_tweets(company, from_date, to_date)

            # Sleep for 10 seconds
            time.sleep(10)
        
    else:
        print("Login failed")

    # close the session
    driver.quit()

    # reading csv file
    apple_df = pd.read_csv("./Apple_Final_Scores_Traders.csv")
    # sorting the dataframe by final_score
    apple_df = apple_df.sort_values(by="final_score",ascending=False)
    
    # returning the dataframe with user_names and final_score columns and resetting the index
    return apple_df[["user_names", "final_score"]].reset_index(drop=True)

if __name__ == "__main__":
    df = main()
    # Convert the dataframe to a html table with borders
    table = tabulate(df.iloc[:10], headers = 'keys', tablefmt = 'html', showindex=False, numalign="right", stralign="center")
    # Define a CSS stylesheet to style the borders
    stylesheet = '<style>table { border-collapse: collapse; } th, td { border: 1px solid black; padding: 5px; }</style>'
    # center the table using CSS
    centered_table = '<center>' + table + '</center>'
    print(stylesheet + centered_table)

    # Connect to the database
    cnx = mysql.connector.connect(user='root', password='BlueDragon!2',
                                host='localhost',
                                database='tfm')

    # Create a cursor object
    cursor = cnx.cursor()

    # Create a table
    table = '''
    CREATE TABLE IF NOT EXISTS correlation (
        ID INT PRIMARY KEY NOT NULL,
        SECTOR_NAME CHAR(50) NOT NULL,
        COMPANY_SHORT_NAME TEXT NOT NULL,
        CF INT NOT NULL
    );
    '''
    cursor.execute(table)

    # Insert values into the table
    add_corr = '''
    INSERT INTO correlation (ID, SECTOR_NAME, COMPANY_SHORT_NAME, CF) 
    VALUES (%s, %s, %s, %s);
    '''
    for idx, row in df.iterrows():
        data = (idx+1, "technology", "AAPL", row["final_score"])
        cursor.execute(add_corr, data)

    # Save the changes
    cnx.commit()

    # Close the cursor and connection
    cursor.close()
    cnx.close()
