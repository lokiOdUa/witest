## Welcome

Please login using existing credentials

If you were opening an internal page (e.g. Comments, Search or Add) you will be relocated to 
the corresponding page after succesful login

Use **Comments** to read and add messages. Page is CSRF-protected by "token" parameter of main 
form. Please note that only 10 last messages will be displayed

Use **Search Phones** to select existing data from the database. You are free to search by numbers 
(From/to price and Vendor ID which means unique phone id by vendor database). "HTML" Data type means 
that data views are rendered at the backend side and then transferred into browser as is (using zip 
compression if we are lucky enough); "JSON" type means that only important data are transferred from 
server to browser and all rendering is done by JavaScript

Use **Add Phone** to enter new phone data and don't hesitate to search for the new one!

Use **Add User** to add new login. Admin rights required, otherwise error page is displayed.

If you will enter login of an existing user then system will warn you and block the corresponding 
form button

#### Please enjoy!)