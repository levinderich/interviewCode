//
//  IngredientsTableViewController.swift
//  RecipeRack
//
//  Created by Levin Derich on 28/6/17.
//  Copyright © 2017 Levin Derich. All rights reserved.
//

import UIKit

class IngredientsTableViewController: UITableViewController {

    // Get the ingredients from the model
    var ingredients = Model.sharedInstance.getIngredients()
    
    @IBAction func buttonPressed(_ sender: Any) {
        
         // Get the value of the cell where the button was pressed
        let buttonTag:UIButton = sender as! UIButton
        let index = buttonTag.tag
        let ingredient = ingredients[index]
        print("You added: \(ingredient)")

        // Add the ingredient to the core data
        let context = (UIApplication.shared.delegate as! AppDelegate).persistentContainer.viewContext
        let list = ShoppingList(context: context) // Link Task & Context
        list.listItem = ingredients[index]
        (UIApplication.shared.delegate as! AppDelegate).saveContext()
        
        // Alert that an item was added to the shopping cart
        let alertController = UIAlertController(title: "Added", message: "\(ingredient) added to the shopping list", preferredStyle: .alert)
        let defaultAction = UIAlertAction(title: "Close", style: .default, handler: nil)
        alertController.addAction(defaultAction)
        
        present(alertController, animated: true, completion: nil)
        
    }
    
    override func viewDidLoad() {
        super.viewDidLoad()
        self.tableView.contentInset = UIEdgeInsetsMake(20, 0, 0, 0)

    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
    }

    override func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }

    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return ingredients.count
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        
        // Get the cell, assign the text for the see and make the button visible on the cell
        // Add the target for the button and return the cell
        let cell = tableView.dequeueReusableCell(withIdentifier: "cell", for: indexPath)
        cell.textLabel?.text = ingredients[indexPath.row]
        
        // Get the button and add the button to the subview
        // Add the target to the button
        let button:UIButton = cell.viewWithTag(1002) as! UIButton
        button.tag = indexPath.row
        cell.contentView.addSubview(button)
        button.addTarget(self, action: #selector(buttonPressed), for: .touchUpInside)
        
        return cell
    }
    

}
