//
//  Model.swift
//  RecipeRack
//
//  Created by Levin Derich on 22/6/17.
//  Copyright © 2017 Levin Derich. All rights reserved.
//

import Foundation

class Model {
    
    // Declare the shipping list and ingredients arrays
    var shoppingList: [ShoppingList] = []
    var ingredients: [String]=[]
    

    /* Here we use a Struct to hold the instance of the model i.e itself*/
    private struct Static
    {
        static var instance: Model?
    }
    
    /* This is a class variable allowing me to access it without first instantiating the model Now we can retrieve the model without instantiating it directly var model = Model.sharedInstance */
    class var sharedInstance: Model
    {
        if !(Static.instance != nil)
        {
            Static.instance = Model()
            
        }
        return Static.instance!
    }

    
    // Delete the whole shopping list
    func deleteShoppingList() {
        print("shopping list deleted!")
        shoppingList.removeAll()
    }

    
    // Return the shopping list
    func getShoppingList() -> Array<ShoppingList> {
        return shoppingList
        
    }

    // Return the ingredients
    func getIngredients() ->Array<String> {
       return ingredients
    }
    
    // Return the ingredients array
    func setIngredients(ingredients: Array<String>){
        self.ingredients = ingredients
        
    }
    

    
}
