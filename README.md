csc309-A3
=========
Documentation of Assignment 3 (CSC 309) - Baseball Card EStore.  

Code Structure:  
3 Models:  
    Order_model - Get, Delete, Insert orders in Database.  
	Product - Get, Delete, Insert, Update products in Database.  
	User_model - Get, Login, Insert, Delete Users in Database.  

Controllers:  
	accounts - User creation and User login  
	admin - Add, delete and edit products  
			  Displaying all finalized orders  
			  Deleting all customer and order information  
	main - 	  Interaction with shopping cart  
	orders - Orders, checkout  
	store - Read, edit and delete products  
	
The app has 4 main interfaces:  
	Catalogue: Collection of all baseball cards that can be purchased by the user.  
	Shopping Cart: User's current shopping cart. Items updated, deleted and user can make the transaction here.  
	Admin Section:	 The admin can login and add, delete and update orders and customer information.  
	Taskbar: The taskbar is separated into 3 types:  
				Anonymous user - Can add items to cart but cannot checkout items from the shopping cart.  
				Registered user - Can add items and then checkout the items by entering credit card info.  
				Admin user - In additional to the registered user, admin has access to the admin section  

Workflow:  
	Create account by clicking 'Create a new account' button on taskbar.  
	Login to the application on taskbar.  
	Add/Remove items to shopping cart in the Catalogue interface.  
	Update/Delete the items in Shopping Cart interface.  
	When ready, enter Credit Card information and checkout the order.  
	Receive an option to print the order and a confirmation email on the user's email ID.  