- 
- create entities with make:entity
Order, Address, Product, OrderItem,  Cart, CartItem, 
- Address: name, address, telephone number, and email
- Order : address, total(float)
SessionAddress(id, session_id, address_id). Repo(save and fetchBySessionId)
- ?? Checkout(StateMachine, has Cart, Address(def is null), Order when placed, saved in session),
- set ProductRepository as preference for ProductRepositoryInterface

- create form and template for adding 1 cart item. How to use it in cycle?
- for adding item to Cart use CartItem and Validator for it. coding-exercise-be-master/app had validators forms
  https://okazy.github.io/symfony-docs/forms.html

- current order in session, to move though checkout

- 1 page checkout, with arrows <- and ->, each click changes Order state. If opened /checkout on 
- another page, it will be automactically opened on same step. 
- ???? Users should be able to add and remove items from their shopping cart at any point during the checkout process except in the state “ordered”.
So, if we added items on PDP, means order is placed with new items? No way to remove items not from Shopping cart page,
unless we have all step on 1 page, opened and unblocked. What sense than in State Machine??
!! I will implement No restriction on adding and removing items on any step, but DONT KNOW HOW TO CHECK IT FROM FRONTEND

-  Use event-based transitions to control the state machine.
Item added -> change checkout state to  "Shopping Cart" state.
 Use  workflow.guard, to no be able to go from Shopping Cart -> Review or Ordered, from Delivery Adddress -> Ordered

- ? Use ADR as architectural pattern https://en.wikipedia.org/wiki/Action%E2%80%93domain%E2%80%93responder
google symfony ADR or PHP ADR examples. if not - fuck it

- Product list page. Button Add and qty (infinite inventory) on each product in list. 
Use AJAX to dynamically show "Product ... was added to the cart.".  And link to cart

- form  "Delivery Address" - name, address, telephone number, and email. Use AJAX to dynamically update
If the delivery address is in a member state of the European Union, the form should also contain 
a field for the user's tax number. This should be implemented using form events.

- If ajax cart updated on checkout, it will update Shopping Cart and Summary for Purchase (if this page) 
- data is stored in order entity, loaded through session using current_order_id
- unit tests for order state machine!!! for adding to cart and placing order success-ly or not (no address, items)
- add to readme that you go to product list page(if first to checkout/cart, page is empty). Add some products.
 by adding product  -> order is created with state Shopping Cart.
By clicking on link "Cart" -> redirected to Shopping Cart Page. on Shopping Cart Page order items list, Total and button 
"Next" -> redirect to Delivery address page.
Button "Next" -> redirects to Summary for Purchase page with order items total.
Button "Next" -> redirects to Ordered page with order data but not editable, or just order id saying order id placed!!.

- Shopping Cart Page items are editable - edit and remove item buttons. On Review page, no such buttons
- Delivery address step - checkbox "Save Address". when proceeding with this set, record to session addresses table
saved. So session_id, address_id .next time user enter site,
this checbox value fetched from Session and show as option in select all addresses related to this session on address step.



- ?? func test, simulation adding product and placing order. 
Example coding-exercise-be-master/app/tests/Controller/Web/UploadControllerTest.php
QUESTIONS:
- There should be a possibility to go back to the last step. Go Back to PREVIOUS step

