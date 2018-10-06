import selenium
from selenium import webdriver  
from selenium.common.exceptions import WebDriverException
import time 


url='http://127.0.0.1/xssbot/admin666.php'
chromedriver = "C:\chromedriver.exe"  
while 1:
    try:
        browser = webdriver.Chrome(chromedriver)
        browser.get(url)
        browser.add_cookie({'name':'key','value':'admin123!@#','path':'/'})
        browser.get(url)
        time.sleep(1)
        browser.quit()
    except Exception as e:
        print (e)
        continue
