//
//  RecipeRackUITests.swift
//  RecipeRackUITests
//
//  Created by Levin Derich on 22/6/17.
//  Copyright © 2017 Levin Derich. All rights reserved.
//

import XCTest

class RecipeRackUITests: XCTestCase {
    
    override func setUp() {
        super.setUp()
        
        // Put setup code here. This method is called before the invocation of each test method in the class.
        
        // In UI tests it is usually best to stop immediately when a failure occurs.
        continueAfterFailure = false
        // UI tests must launch the application that they test. Doing this in setup will make sure it happens for each test method.
        XCUIApplication().launch()
        
        // In UI tests it’s important to set the initial state - such as interface orientation - required for your tests before they run. The setUp method is a good place to do this.
    }
    
    override func tearDown() {
        // Put teardown code here. This method is called after the invocation of each test method in the class.
        super.tearDown()
    }
    
    func testExample() {
        // Use recording to get started writing UI tests.
        // Use XCTAssert and related functions to verify your tests produce the correct results.
    }
    
    func testMainPage() {
        // reference to main app
        let app = XCUIApplication()
        
        // Test that the buttons are called what they should be
        //        var string = app.staticTexts.element(matching: .any, identifier:"RecipeBookButton").label
        //        var string = app.staticTexts.element(matching: .any, identifier:"ShoppingListButton").label
        
        
        //        XCTAssertEqual(string, "")
        
        // check that name of the app is "Receipe Rack" - Not working
        //        XCTAssertEqual(app.staticTexts("Receipe Rack").exists)
        
        
        // Test that there is one image on the main page
        XCTAssertEqual(app.images.count, 1)
        
        // Test that there is two buttons on the main page, plus 3 on the tab bar for a total of 5
        XCTAssertEqual(app.buttons.count, 5)
        
        
    }
    
    
    func testWalkThru() {
        // reference to main app
        let app = XCUIApplication()
        
        // click on recipe button on tab bar controller
        let tabBarsQuery = app.tabBars
        tabBarsQuery.buttons["Recipe"].tap()
        sleep(2)
        
        // click on shopping list button on tab bar controller
        tabBarsQuery.buttons["Shopping List"].tap()
        sleep(2)
        
        // click on home button on tab bar controller to the main page
        tabBarsQuery.buttons["Home"].tap()
        sleep(2)
      
        // press Recipe Button to go to Recipe Page
        app.buttons["RecipeBookButton"].tap()
        sleep(1)
        
        // click on back button to go back to main page
        app.navigationBars["Recipe Book"].children(matching: .button).matching(identifier: "Back").element(boundBy: 0).tap()
        sleep(2)

        // press Recipe Button to go to Recipe Page
        app.buttons["RecipeBookButton"].tap()
        sleep(1)
        
        // click on first recipe and it is displayed
        app.tables.staticTexts["Vietnamese Rice Paper Rolls"].tap()
        sleep(2)
        
        // click on view ingredients page
        app.buttons["View Ingredients"].tap()
        
        // add three ingredients to the shopping list
        // click on Garlic and select it
        let tablesQuery = app.tables
        tablesQuery.staticTexts["Garlic"].tap()
        tablesQuery.cells.containing(.staticText, identifier:"Garlic").buttons["+"].tap()
        sleep(1)
        
        // click on cooked tiger prawns and select it
        tablesQuery.staticTexts["250g Cooked Tiger Prawns"].tap()
        tablesQuery.cells.containing(.staticText, identifier:"250g Cooked Tiger Prawns").buttons["+"].tap()
        sleep(1)
        
        // click on rice paper sheets and select it
        tablesQuery.staticTexts["Rice Paper Sheets"].tap()
        tablesQuery.cells.containing(.staticText, identifier:"Rice Paper Sheets").buttons["+"].tap()
        sleep(2)
        
        // click on back button to return to recipe page
        app.navigationBars["Ingredients"].children(matching: .button).matching(identifier: "Back").element(boundBy: 0).tap()
        sleep(2)
        
        // click on back button to return to list of recipes
        app.navigationBars["Recipe"].children(matching: .button).matching(identifier: "Back").element(boundBy: 0).tap()
        // click on back button to return to main menu
        app.navigationBars["Recipe Book"].children(matching: .button).matching(identifier: "Back").element(boundBy: 0).tap()
        sleep(2)
        
        // click on shopping list button main screen, then come back to the main screen
        app.buttons["ShoppingButton"].tap()
        sleep(2)
        
        // delete an item from the shopping list
        tablesQuery.staticTexts["Garlic"].tap()
        tablesQuery.cells.containing(.staticText, identifier:"Garlic").buttons["-"].tap()
        // go back to main menu
        app.navigationBars["Shopping List"].children(matching: .button).matching(identifier: "Back").element(boundBy: 0).tap()
        sleep(2)

        
    }


    
}

