//
//  ShoppingList+CoreDataProperties.swift
//  RecipeRack
//
//  Created by Levin Derich on 15/7/17.
//  Copyright © 2017 Levin Derich. All rights reserved.
//

import Foundation
import CoreData


extension ShoppingList {

    @nonobjc public class func fetchRequest() -> NSFetchRequest<ShoppingList> {
        return NSFetchRequest<ShoppingList>(entityName: "ShoppingList")
    }

    @NSManaged public var listItem: String?

}
