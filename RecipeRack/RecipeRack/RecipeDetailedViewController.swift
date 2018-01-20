//
//  RecipeDetailedViewController.swift
//  RecipeRack
//
//  Created by Levin Derich on 25/6/17.
//  Copyright © 2017 Levin Derich. All rights reserved.
//

import UIKit

class RecipeDetailedViewController: UIViewController {
    
    // Declare the variables for recipe name and instructions
    var recipeName:String?
    var instructions:String?
    var imageURL:String?
    var ingredients: [String] = []
    var image:UIImageView?
    var dietLabel:[String] = []
    var healthLabel:[String] = []
    var caloriesLabel:Int?
    var caloriesString:String!
    var recipeURL:String?

    // Outlets for the image, title and the diet, health and calorie labels
    @IBOutlet weak var recipeImage: UIImageView!
    @IBOutlet weak var titleRecipe: UITextField!
    @IBOutlet weak var labelDiet: UILabel!
    @IBOutlet weak var labelHealth: UILabel!
    @IBOutlet weak var labelCalories: UILabel!
    
    // Button to take the user to the recipe
    @IBAction func viewInstructions(_ sender: Any) {
        if let url = NSURL(string: recipeURL!){ UIApplication.shared.open(url as URL, options: [:], completionHandler: nil) }
    }
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        // Get the image from the URL
        get_image(imageURL!, recipeImage)
        caloriesString = String(caloriesLabel!)
        
        // Set the image, recipe title and the health, dietary and calories labels
        titleRecipe.text = recipeName
        labelDiet.text = "Dietary Label: \(dietLabel[0])"
        labelHealth.text = "Health Label: \(healthLabel[0])"
        labelCalories.text = "Total Calories: \(caloriesString!)"
        Model.sharedInstance.setIngredients(ingredients: ingredients)
        
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()

    }
    
    // Download the image from the API's URL
    func get_image(_ url_str:String, _ imageView:UIImageView)
    {
        let url:URL = URL(string: url_str)!
        let session = URLSession.shared
        
        let task = session.dataTask(with: url, completionHandler: {
            (
            data, response, error) in
            if data != nil
            {
                let image = UIImage(data: data!)
                
                if(image != nil)
                {
                    DispatchQueue.main.async(execute: {
                        
                        imageView.image = image
                    })
                }
            }
        
        })
        // Start the task
        task.resume()
    }

}

