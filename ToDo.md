Project Overview
You are tasked with building a shopping cart checkout system using Symfony/Workflow and ORM. The system should allow users to add items to their cart, enter their delivery information, and review a summary of their purchase before finalizing their order.

Requirements
1. Create a Symfony/Workflow state machine with four states: "Shopping Cart", "Delivery Address", "Summary for Purchase", “Ordered”.
2. Use event-based transitions to control the state machine.
3. When a user enters the "Delivery Address" state, they should be presented with a form to enter their name, address, telephone number, and email.
4. If the delivery address is in a member state of the European Union, the form should also contain a field for the user's tax number. This should be implemented using form events.
5. Users should be able to add and remove items from their shopping cart at any point during the checkout process except in the state “ordered”.
6. There should be a possibility to go back to the last step.
7. Once the user has reviewed their purchase summary, they should be able to finalize their order and receive a confirmation message.

Technical Requirements
1. The system should be built using Symfony and Doctrine ORM.
2. Use Twig for rendering templates.
3. Use ADR as architectural pattern https://en.wikipedia.org/wiki/Action%E2%80%93domain%E2%80%93responder


Bonus Points
1. Allow users to save their delivery address information for future purchases.
2. Use AJAX to dynamically update the shopping cart and delivery address form.
3. Implement tests to ensure that the checkout process works correctly.

Deliverables
1. A Git repository with your code.
2. Documentation on how to run the application and its tests.