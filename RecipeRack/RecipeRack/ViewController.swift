//
//  ViewController.swift
//  RecipeRack
//
//  Created by Levin Derich on 22/6/17.
//  Copyright © 2017 Levin Derich. All rights reserved.
//

import UIKit
import CoreMotion

class ViewController: UIViewController {
    
    // Outlets for the text field and label
    @IBOutlet weak var ingredientOut: UITextField!
    @IBOutlet weak var outputLabel: UILabel!
    
    var observedText = Observable<String>(value: "")
    
    override func viewDidLoad() {
        super.viewDidLoad()
    
        // Set the label to the observed text
        observedText.observe { (value: String) -> () in
            self.outputLabel.text = "Search for a recipe that contains \(value)"
        }
        ingredientOut.addTarget(self, action: #selector(textDidChange), for: .editingChanged)
    }
    
    // Function to get the text when changed
    @objc func textDidChange() {
        observedText.value = ingredientOut.text!
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
    }
    
    // Pass entered ingredient to the RecipeBookTableViewController
    override func prepare (for segue: UIStoryboardSegue, sender: Any?) {
    
        let detailsVC = segue.destination as! RecipeBookTableViewController
        let ingredient = self.ingredientOut.text
        let destinationIngredient = ingredient
        detailsVC.ingredient = destinationIngredient
        
    }
}


// Struct for the observable pattern
struct Observable<T> {
    
    var observers: [(T)->()] = []
    
    var value: T {
        didSet {
            observers.forEach { $0(value) }
        }
    }
    
    mutating func observe(observer: @escaping (T)->()) {
        observers.append(observer)
    }
    
    init (value: T) {
        self.value = value
    }
}


