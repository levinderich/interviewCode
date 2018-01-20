//
//  RecipeBookTableViewController.swift
//  RecipeRack
//
//  Created by Levin Derich on 23/6/17.
//  Copyright © 2017 Levin Derich. All rights reserved.
//

import UIKit
import Alamofire
import SwiftyJSON

class RecipeBookTableViewController: UITableViewController {
    
    // Create an array from the JSON Data
    var arrRes = [[String:AnyObject]]()
    
    // Set a default recipe ingredient
    var ingredient:String? = "Chicken"
    
    override func viewDidLoad() {
        super.viewDidLoad()
        self.tableView.contentInset = UIEdgeInsetsMake(20, 0, 0, 0)
        
        // App key details
        let part1 = "https://api.edamam.com/search?q="
        let part2 = "&app_id=0a794f11&app_key=8e6faa468a234656052a29d420d336ba"
        
        // Use SwiftyJSON and Alamofire to retrieve data from the API
        Alamofire.request(part1 + ingredient! + part2).responseJSON { (responseData) -> Void in
            if((responseData.result.value) != nil) {
                let swiftyJsonVar = JSON(responseData.result.value!)
                print(swiftyJsonVar)
                if let resData = swiftyJsonVar["hits"].arrayObject {
                    self.arrRes = resData as! [[String:AnyObject]]
                    print(self.arrRes.count)
                }
                if self.arrRes.count > 0 {
                    self.tableView.reloadData()
                }
            }
            else {print(self.arrRes.count)}
        }

        
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
    }
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return arrRes.count
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        
        // Get the cell and assign the text for the label
        let cell = tableView.dequeueReusableCell(withIdentifier: "reuseIdentifier", for: indexPath)
        var dict = arrRes[indexPath.row]
        cell.textLabel?.text = dict["recipe"]?["label"] as? String
        return cell
    }
    
    override func prepare (for segue: UIStoryboardSegue, sender: Any?)
    {
        // Pass the values for the recipe information to the RecipeDetailedViewController
        let indexPath = self.tableView.indexPathForSelectedRow!
        let detailsVC = segue.destination as! RecipeDetailedViewController
        var dict = arrRes[indexPath.row]
        
        // Get the data from the API
        // Data is located within dictionary. Values are retreived using their key and assigned to variables
        let destinationTitle = dict["recipe"]?["label"] as? String
        let destinationImage = dict["recipe"]?["image"] as? String
        let destinationIngredients = dict["recipe"]?["ingredientLines"] as! [String]
        let destinationDiet = dict["recipe"]?["dietLabels"] as! [String]
        let destinationHealth = dict["recipe"]?["healthLabels"] as! [String]
        let destinationCalories = dict["recipe"]?["calories"] as! Int
        let destinationURL = dict["recipe"]?["url"] as? String
        
        // Pass the variable values to the detailed view
        detailsVC.recipeURL = destinationURL
        detailsVC.recipeName = destinationTitle
        detailsVC.imageURL = destinationImage
        detailsVC.ingredients = destinationIngredients
        detailsVC.dietLabel = destinationDiet
        detailsVC.healthLabel = destinationHealth
        detailsVC.caloriesLabel = destinationCalories
    }
    
}
