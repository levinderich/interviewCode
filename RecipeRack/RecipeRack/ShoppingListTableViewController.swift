//
//  ShoppingListTableViewController.swift
//  RecipeRack
//
//  Created by Levin Derich on 25/6/17.
//  Copyright © 2017 Levin Derich. All rights reserved.
//

import UIKit
import CoreMotion

class ShoppingListTableViewController: UITableViewController {
    
    // Get the shopping list from the model
    var shoppingList = Model.sharedInstance.getShoppingList()
    
    let context = (UIApplication.shared.delegate as! AppDelegate).persistentContainer.viewContext
    
    
    // If Shaken then give user the option to delete shopping list
    override func motionBegan(_ motion: UIEventSubtype, with event: UIEvent?) {
        print("Device was shaken!")
        
        // Give user the option to empty Shopping List
        shakeHappened()
    }
    
    
    // Function to alert the user and let them decide to empty the shopping list
    func shakeHappened() {
        // Give the user the option to delete the shopping list
        // User can cancel or delete
        let alertController = UIAlertController(title: "Message", message: "Do you want to completely EMPTY the Shopping List?", preferredStyle: .alert)
        let deleteButton = UIAlertAction(title: "Yes", style: .destructive, handler: yesEmpty )
        let cancelButton = UIAlertAction(title: "No", style: .cancel, handler: noEmpty )
        alertController.addAction(cancelButton)
        alertController.addAction(deleteButton)
        self.navigationController!.present(alertController, animated: true, completion: nil)
    }
    
    
    // User said TO empty shopping list
    func yesEmpty(alert: UIAlertAction){
        print("EMPTY Shopping list")
        // Delete the shopping list
        Model.sharedInstance.deleteShoppingList()
        
        // Display an alert to advise shopping list emptied
        let alertController = UIAlertController(title: "Message", message: "Shopping List emptied", preferredStyle: .alert)
        let dismissButton = UIAlertAction(title: "Dismiss", style: .default, handler: nil)
        alertController.addAction(dismissButton)
        self.navigationController!.present(alertController, animated: true, completion: nil)
        
        // Save the updated (emptied) shopping list into the core data
        for ingredient in shoppingList {
            context.delete(ingredient)
            (UIApplication.shared.delegate as! AppDelegate).saveContext()
            
            do {
                shoppingList = try context.fetch(ShoppingList.fetchRequest())
            }
            catch {
                print("Unable to fetch data")
            }
            
        }
        // Reload the tableview
        tableView.reloadData()

    }
    
    
    // User said DON'T empty shopping list
    func noEmpty(alert: UIAlertAction){
        print("Shopping List NOT emptied")
        let alertController = UIAlertController(title: "Message", message: "Shopping List NOT emptied", preferredStyle: .alert)
        let dismissButton = UIAlertAction(title: "Dismiss", style: .default, handler: nil)
        alertController.addAction(dismissButton)
        self.navigationController!.present(alertController, animated: true, completion: nil)
    }

    
    override func viewDidLoad() {
        super.viewDidLoad()
        tableView.delegate = self
        tableView.dataSource = self
        self.tableView.contentInset = UIEdgeInsetsMake(20, 0, 0, 0)

    }
    
    override func viewWillAppear(_ animated: Bool) {
        getData()
        tableView.reloadData()
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
    }
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return shoppingList.count
    }
    
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        
        // Get the cell, assign the text for the see and make the button visible on the cell
        // Add the target for the button and return the cell
        let cell = tableView.dequeueReusableCell(withIdentifier: "reuseIdentifier", for: indexPath)
        let list = shoppingList[indexPath.row]
        
        if let item = list.listItem {
            cell.textLabel?.text = item
        }
        
        return cell
        
    }

    // Get the shopping list from the core data
    func getData() {
        do {
            shoppingList = try context.fetch(ShoppingList.fetchRequest())
        }
        catch {
            print("Unable to fetch data")
        }
    }
    
    override func tableView(_ tableView: UITableView, commit editingStyle: UITableViewCellEditingStyle, forRowAt indexPath: IndexPath) {
        // Delete the item from the shopping cart if the delete button is selected
        if editingStyle == .delete {
            let list = shoppingList[indexPath.row]
            context.delete(list)
            (UIApplication.shared.delegate as! AppDelegate).saveContext()
            
            do {
                shoppingList = try context.fetch(ShoppingList.fetchRequest())
            }
            catch {
                print("Unable to fetch data")
            }
        }
        // Reload the tableview with the updated shopping list
        tableView.reloadData()
    }
    
    
}
