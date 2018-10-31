import os
import time
import string
import random

#def id_generator(size=6, chars=string.ascii_uppercase + string.digits):
#   return ''.join(random.choice(chars) for _ in range(size))

def main():

    showMenu()
    
    userInput = input("Choice: ")
    evaluateChoice(userInput)


def showMenu():
    print("*****Options*****")
    print("1. Vendor Entry")  #Done (Manual Entry)
    print("2. Product Entry") #Done (Manual Entry)
    print("3. Order Entry") #NEEDS WORK (Generated)
    print("4. Order Item Entry") #NEEDS WORK (Generated)
    print("5. Customer Entry") #Done (Generated)
    print("6. User Entry") #Done (Manual Entry)
    print("0. Exit\n") #Done
    print("7. Debug\n")

def evaluateChoice(choice):
    if choice == '1':
        vendorEntry()
    elif choice == '2':
        productEntry()
    elif choice == '3':
        orderEntry()
    elif choice == '4':
        orderItemEntry()
    elif choice == '5':
        customerEntry()
    elif choice == '6':
        userEntry()
    elif choice == '0':
        exitProgram()
    elif choice == '7':
        print("DEBUGGING!")
        customer = generateCustomer()

        custID = customer[0]
        fname = customer[1]
        mname = customer[2]
        lname = customer[3]
        addTown = customer[4]
        addState = customer[5]
        zipCode = customer[6]
        pNum = customer[7]

        cName = ""
        email = ""
        addStreet = ""

        print(custID + " " + fname + " " + mname + " " + lname + " " + addTown + ", " + addState + " " + zipCode + " " + pNum)
        
        #print("Customer ID: " + str(custID))
    else:
        print("Invalid Choice\n")
        userInput = input("Choice: ")
        evaluateChoice(userInput)
        
def vendorEntry():
    print("\n******Vendor Entry******")
    printOptions("Vendor Code")

    firstRun = False

    while True:
        vCode = input("Vendor Code(EX: AL): ")
        if vCode == 'menu':
            print("")
            main()
            break;
        elif vCode == 'quit':
            break;

        if not firstRun:
            file = open("Vendors.sql","a")
            file.write("INSERT INTO `VENDORS` (`Vcode`, `Vname`) VALUES")
            firstRun = True
            
        file.write("\n")
        file.write("('" + vCode.upper() + "', ")
        vName = input("Vendor Name(EX: Alfalux): ")
        file.write("'" + vName.title() + "'),")
        print("")

    file.seek(file.tell() - 1, os.SEEK_SET)
    file.truncate()
    file.write(';')
    
    file.write("\n\n")

    file.close()
    
def productEntry():
    print("\n******Product Entry******")
    printOptions("Supplier Code")

    goodID = "default"
    supplierCode = ""
    vendorCode = ""
    styleName = ""
    tileSize = ""
    color = ""
    lot = randomGenerator('lot') #Randomly Generated
    location = randomGenerator('location') #Try to Randomly Generate
    amount = randomGenerator('amount') #Randomly Generated(Pc Count)
    unitPrice = "0.00"
    colors = []
    firstRun = False
    
    #print("Lot: " + lot)
    #print("Location: " + location)
    #print("Amount: " + amount)
            

    while True:
        supplierCode  = input("Supplier Code(EX: ALFEN24): ")
        if supplierCode  == 'menu':
            print("")
            main()
            break;
        elif supplierCode  == 'quit':
            break;

        if not firstRun:
            file = open("Goods.sql","a")
            file.write("INSERT INTO `GOODS` (`GoodID`, `SupplierCode`, `VendorCode`, `StyleName`, `TileSize`, `Color`, `Lot`, `Location`, `Amount`, `UnitPrice`) VALUES")
            firstRun = True

        file.write("\n")
        #Write the default goodID, will autoincriment
        file.write("('" + goodID.upper() + "', ")
        
        file.write("'" + supplierCode.upper() + "', ")
        vendorCode = input("Vendor Code(EX: AL): ")
        file.write("'" + vendorCode.upper() + "', ")
        styleName = input("Style Name(EX: Fenix): ")
        file.write("'" + styleName.title() + "', ")
        tileSize = input("Tile Size(EX: 12x24): ")
        file.write("'" + tileSize.lower() + "', ")
        color = input("Color(EX: Blue): ")
        file.write("'" + color.title() + "', ")
        colors.append(color)

        #Regenerate the values
        lot = randomGenerator('lot') #Randomly Generated
        location = randomGenerator('location') #Try to Randomly Generate
        amount = randomGenerator('amount') #Randomly Generated(Pc Count)
        
        #Write the 3 generated values
        file.write("'" + lot + "', ")
        file.write("'" + location + "', ")
        file.write("'" + amount + "', ")
    
        unitPrice = input("Price(EX: 1.25): ")
        file.write("'" + unitPrice + "'),")
        print("")

        #Generate a few lots of the same tile
        for x in range(random.randint(1,4)):
            file.write("\n")
            file.write("('" + goodID.upper() + "', ")
            file.write("'" + supplierCode.upper() + "', ")
            file.write("'" + vendorCode.upper() + "', ")
            file.write("'" + styleName.title() + "', ")
            file.write("'" + tileSize.lower() + "', ")
            file.write("'" + color.title() + "', ")
            
            lot = randomGenerator('lot') #Randomly Generated
            location = randomGenerator('location') #Try to Randomly Generate
            amount = randomGenerator('amount') #Randomly Generated(Pc Count)
            
            file.write("'" + lot + "', ")
            file.write("'" + location + "', ")
            file.write("'" + amount + "', ")
            file.write("'" + unitPrice + "'),")

        while True:
            userChoice = input("Any more colors for this style/size tile? (y/n): " )
        
            if userChoice.upper() == 'Y':
                color = input("Color(EX: Blue): ")
                colors.append(color)
                print("")

                #Generate a few lots of the same tile
                for x in range(random.randint(1,4)):
                    file.write("\n")
                    file.write("('" + goodID.upper() + "', ")
                    file.write("'" + supplierCode.upper() + "', ")
                    file.write("'" + vendorCode.upper() + "', ")
                    file.write("'" + styleName.title() + "', ")
                    file.write("'" + tileSize.lower() + "', ")
                    file.write("'" + color.title() + "', ")
            
                    lot = randomGenerator('lot') #Randomly Generated
                    location = randomGenerator('location') #Try to Randomly Generate
                    amount = randomGenerator('amount') #Randomly Generated(Pc Count)
            
                    file.write("'" + lot + "', ")
                    file.write("'" + location + "', ")
                    file.write("'" + amount + "', ")
                    file.write("'" + unitPrice + "'),")
                
            elif userChoice.upper() == 'N':
                print("")
                break;

        while True:
            userChoice = input("Any more sizes (y/n): " )
        
            if userChoice.upper() == 'Y':
                supplierCode  = input("Supplier Code(*DON'T QUIT HERE!!*): ")
                tileSize = input("Tile Size(EX: 12x24): ")
                unitPrice = input("Price(EX: 1.25): ")
            
                print("")
                for color in colors:    
                    #Generate a few lots of the same tile
                    for x in range(random.randint(1,4)):
                        file.write("\n")
                        file.write("('" + goodID.upper() + "', ")
                        file.write("'" + supplierCode.upper() + "', ")
                        file.write("'" + vendorCode.upper() + "', ")
                        file.write("'" + styleName.title() + "', ")
                        file.write("'" + tileSize.lower() + "', ")
                        file.write("'" + color.title() + "', ")
            
                        lot = randomGenerator('lot') #Randomly Generated
                        location = randomGenerator('location') #Try to Randomly Generate
                        amount = randomGenerator('amount') #Randomly Generated(Pc Count)
            
                        file.write("'" + lot + "', ")
                        file.write("'" + location + "', ")
                        file.write("'" + amount + "', ")
                        file.write("'" + unitPrice + "'),")
                
            elif userChoice.upper() == 'N':
                colors = []
                print("")
                break;       
                
    file.seek(file.tell() - 1, os.SEEK_SET)
    file.truncate()
    file.write(';')
    
    file.write("\n\n")
    
    file.close()

def generateOrders():

    cids = orderEntryCustomers()
    cnum = len(cids)-1
    ctypes = checkCustomer()

    goods = [] # Will be a 2d array access with goods[listnum][elemnum]

    count = 0
    orderNum = 2740000
    randItems = 0
    randItemNums = []
    randAmount = 0

    orderType = "Pick-Up"
    
    #1801 Good Entries

    salesperson = ["Justin", "Joe", "Loren", "Josh"]
    sNum = len(salesperson) - 1
    orderTypes = ["Pick-Up", "Truck", "UPS", "Other"]
    oNum = len(orderTypes) - 1

    #Orders need OrderNum, Salesperson, CustID, and OrderType
    print("Generating Orders")

    file = open("OrderItems.sql","a")
    file.write("INSERT INTO `ORDERITEMS` (`OrderNum`, `ItemID`, `Quantity`) VALUES")

    
    ####FILE 2#######
    file2 = open("Orders.sql","a")
    file2.write("INSERT INTO `ORDERS` (`OrderNum`, `Salesperson`, `CustID`, `OrderType`) VALUES")
    

    while count < 600:

        crand = random.randint(0, cnum)
        customer = cids[crand] #ORDER CUST ID
        ctype = ctypes[crand]

        if ctype == "C":
            orderType = orderTypes[0]
        elif ctype == "B":
            orderType = orderTypes[1]

        
        randItems = random.randint(1,12)#Number of items on order
        
        itemCount = 0
        
        while itemCount < randItems:
            #ORDER ITEMS NEED Order Num, ItemId, and Quantity
            item = [] # Will hold item num and quantity
            randItemNum = random.randint(1,1801)
            randQuantity = random.randint(1,250)

            file.write("\n")
            file.write("('" + str(orderNum) + "', ")
            file.write("'" + str(randItemNum) + "', ")
            file.write("'" + str(randQuantity) + "'),")
            
            #item.append(customer)
            #item.append(randItemNum)
            #item.append(randQuantity)
            #goods.append(item)
            itemCount += 1


        ###File 2 Write###
        file2.write("\n")
        file2.write("('" + str(orderNum) + "', ")
        file2.write("'" + salesperson[random.randint(0,3)].upper() + "', ")
        file2.write("'" + customer + "', ")
        file2.write("'" + orderType + "'),")

        orderNum = orderNum + 1
        count += 1




    #print("Ordernum: " + str(orderNum))
    #print("Customer: " + str(goods[1][0]))
    #print("Item: " + str(goods[1][1]))
    #print("Quantity: " + str(goods[1][2]))
    #print("Goods: " + str(goods))

    file.seek(file.tell() - 1, os.SEEK_SET)
    file.truncate()
    file.write(';')
    
    file.write("\n\n")
    
    file.close()

    ####FILE 2 CLOSING#######
    file2.seek(file2.tell() - 1, os.SEEK_SET)
    file2.truncate()
    file2.write(';')
    
    file2.write("\n\n")
    
    file2.close()


def orderEntryCustomers():
    file = open("Customers.sql","r")

    customers = []
    count = 0

    lines = [line.rstrip('\n') for line in open('Customers.sql')]
    del lines[-1]

    for line in lines:
        if """('""" in line:
            stored_line = (line[2] + line[3] + line[4] + line[5] + line[6])
            spellNull = (line[9] + line[10] + line [11] + line[12])
            customers.append(stored_line)
            #print (spellNull)
            #print (stored_line)
            count += 1

    #print (count)    
    file.close()

    return customers

def checkCustomer():
    file = open("Customers.sql","r")

    custType = []
    count = 0

    lines = [line.rstrip('\n') for line in open('Customers.sql')]
    del lines[-1]

    for line in lines:
        if """('""" in line:
            stored_line = (line[9] + line[10] + line [11] + line[12])
            if stored_line == "NULL":
                custType.append("B")
            else:
                custType.append("C")

            count += 1
            
    #print (custType)
    #print (stored_line)
            

    #print (count)    
    file.close()

    return custType

def customerEntry():
    print("******Customer Entry******")
    printOptions("First Name")

    #custID = randomGenerator('custID')
    firstRun = False

    while True:
        print("Generating Customers")
        #choice = input("Generate Customers: ")
        #if choice == 'menu':
        #    print("")
        #    main()
        #    break
        #elif choice == 'quit':
        #    break

        if not firstRun:
            file = open("Customers.sql","a")
            file.write("INSERT INTO `CUSTOMERS` (`CustID`, `Fname`, `Mname`, `Lname`, `CompanyName`, `AddStreet`, `AddTown`, `AddState`, `AddZip`, `PhoneNum`, `Email`) VALUES")
            firstRun = True

        file.write("\n")

        customer = []
        buisness = []
        
        count = 0

        while count < 100:
            if count < 50:
                #Generate Customer
                customer = generateCustomer()

                custID = customer[0]
                fName = customer[1]
                mName = customer[2]
                lName = customer[3]
                addTown = customer[4]
                addState = customer[5]
                zipCode = customer[6]
                pNum = customer[7]

                cName = ""
                email = ""
                addStreet = ""

                file.write("('" + custID.upper() + "',")
                file.write("'" + fName.title() + "',")
                file.write("'" + mName.title() + "',")
                file.write("'" + lName.title() + "',")
                file.write("'" + cName.title() + "',")
                file.write("'" + addStreet.title() + "',")
                file.write("'" + addTown.title() + "',")
                file.write("'" + addState.upper() + "',") 
                file.write("'" + zipCode + "',")
                file.write("'" + pNum + "',")
                file.write("'" + email + "'),")
                file.write("\n")

                count+=1
                    
            elif count > 50 and count < 100:
                #Generate Buisnesses
                buisness = generateBuisness(count)

                custID = buisness[0]
                cName = buisness[1]
                pNum = buisness[2]
                email = buisness[3]
                addStreet = buisness[4]
                addTown = buisness[5]
                addState = buisness[6]
                zipCode = buisness[7]

                fName = ""
                mName = ""
                lName = ""         

                file.write("('" + custID.upper() + "',")
                file.write("'" + fName.title() + "',")
                file.write("'" + mName.title() + "',")
                file.write("'" + lName.title() + "',")
                file.write("'" + cName.title() + "',")
                file.write("'" + addStreet.title() + "',")
                file.write("'" + addTown.title() + "',")
                file.write("'" + addState.upper() + "',") 
                file.write("'" + zipCode + "',")
                file.write("'" + pNum + "',")
                file.write("'" + email + "'),")
                if count != 99:
                    file.write("\n")
                
                count+=1
            else:
                count+=1
        break

        print("")

        #Regenerate Customer ID
        #custID = randomGenerator('custID')

    file.seek(file.tell() - 1, os.SEEK_SET)
    file.truncate()
    file.write(';')
    
    file.write("\n\n")
    
    file.close()

def userEntry():
    print("******User Entry******")
    printOptions("User Name")

    userID = "default"
    firstRun = False
    
    while True:
        userName = input("Username: ")
        if userName == 'menu':
            print("")
            main()
            break;
        elif userName == 'quit':
            break;

        if not firstRun:
            file = open("Users.sql","a")
            file.write("INSERT INTO `USERS` (`UserID`, `Username`, `EncryptedPass`, `Fname`, `Mname`, `Lname`, `Security`) VALUES")
            firstRun = True
            
        file.write("\n")
        file.write("('" + userID.upper() + "', ")
        file.write("'" + userName.upper() + "', ")
        encryptPass = randomGenerator('password')
        file.write("'" + encryptPass + "', ")
        fName = input("First Name: ")
        file.write("'" + fName.title() + "',")
        mName = input("Middle Name: ")
        file.write("'" + mName.title() + "',")
        lName = input("Last Name: ")
        file.write("'" + lName.title() + "',")
        security = input("Security Level: ")
        file.write("'" + security.title() + "'),")
        print("")

    file.seek(file.tell() - 1, os.SEEK_SET)
    file.truncate()
    file.write(';')
    
    file.write("\n\n")
    
    file.close()

def printOptions(attribute):
    print("\nType menu in " + attribute + " to access the menu")
    print("or quit to exit the program\n")


def randomGenerator(randType):
    if randType == 'lot':
        size = 4;
        chars = string.ascii_uppercase + string.digits;
        return ''.join(random.choice(chars) for _ in range(size))
    elif randType == 'location':
        aisle = random.randint(1,53)
        if aisle == 26:
            bay = random.choice("ABCDEFGHIJKLMNO")
        else:
            bay = random.choice("ABCDEFG")
        spot = random.randint(1,10)
        return ''.join([str(aisle), '-', bay, '-', str(spot)])
    elif randType == 'amount':
        return str(random.randint(0,6000))
    elif randType == 'password':
        size = 8;
        chars = string.ascii_uppercase + string.digits;
        return ''.join(random.choice(chars) for _ in range(size))
    elif randType =='custID':
        #Letter followed by 4 numbers
        #random.choice(chars)
        chars = string.ascii_uppercase
        numbers = string.digits
        size = 4
        genLetter = random.choice(chars)
        genNum = ''.join(random.choice(numbers) for _ in range(size))
        return ''.join([genLetter, genNum])
    elif randType == 'minitial':
        chars = string.ascii_uppercase
        genLetter = random.choice(chars)
        return genLetter

def generateCustomer():
    #`CustID`, `Fname`, `Mname`, `Lname`, `CompanyName`, `AddStreet`, `AddTown`, `AddState`, `AddZip`, `PhoneNum`, `Email`
    custInfo = []
    fnames = [line.rstrip() for line in open('first-names.txt')]
    numfnames = len(fnames) - 1
    lnames = [line.rstrip() for line in open('last-names.txt')]
    numlnames = len(lnames) - 1
    address = [line.rstrip() for line in open('AddressNames.txt')]
    addNum = len(address) - 1
    phonenumbs = [line.rstrip() for line in open('PhoneNumbers.txt')]
    pNums = len(phonenumbs) - 1

    #streets = []
    towns = []
    states = []
    zips = []

    custID = randomGenerator('custID')
    fname = fnames[random.randint(0, numfnames)]
    minitial = randomGenerator('minitial')
    lname = lnames[random.randint(0, numlnames)]
    #compName = ""
    #addStreet = ""

    count = 1

    for line in address:
        if count == 1:
            count +=1
        elif count == 2:
            addTown, addState, addZip = line.split(",")     
            addState = addState.lstrip()
            addZip = addZip.lstrip()
            
            towns.append(addTown)
            states.append(addState)
            zips.append(addZip)
            count+=1
        else:
            count = 1

    tNums = len(towns) - 1
    randAdd = random.randint(0, tNums)
    
    addTown = towns[randAdd]
    addState = states[randAdd]
    addZip = zips[randAdd]
            
    phoneNum = phonenumbs[random.randint(0, pNums)]

    print(custID + " " + fname + " " + minitial + " " + lname + " " + addTown + ", " + addState + " " + addZip + " " + phoneNum)

    custInfo.append(custID)
    custInfo.append(fname)
    custInfo.append(minitial)
    custInfo.append(lname)
    custInfo.append(addTown)
    custInfo.append(addState)
    custInfo.append(addZip)
    custInfo.append(phoneNum)

    #print(custInfo)
    
    return custInfo

def generateBuisness(num):

    buisnessInfo = []
    
    compnames = [line.rstrip() for line in open('CompanyNames.txt')]
    compNum = len(compnames) - 1
    address = [line.rstrip() for line in open('AddressNames.txt')]
    addNum = len(address) - 1
    phonenumbs = [line.rstrip() for line in open('PhoneNumbers.txt')]
    pNums = len(phonenumbs) - 1

    fnames = [line.rstrip() for line in open('first-names.txt')]
    numfnames = len(fnames) - 1
    lnames = [line.rstrip() for line in open('last-names.txt')]
    numlnames = len(lnames) - 1
    fname = fnames[random.randint(0, numfnames)]
    lname = lnames[random.randint(0, numlnames)]

    streets = []
    towns = []
    states = []
    zips = []
    
    

    custID = randomGenerator('custID')
    compName = compnames[num]

    count = 1
    
    for line in address:
        if count == 1:
            addStreet = line
            
            streets.append(addStreet)
            
            count +=1
        elif count == 2:

            addTown, addState, addZip = line.split(",")
            addState = addState.lstrip()
            addZip = addZip.lstrip()
    
            towns.append(addTown)
            states.append(addState)
            zips.append(addZip)
            
            count += 1
        else:
            count = 1

    stNums = len(streets) - 1
    randAdd = random.randint(0, stNums)
    
    addStreet = streets[randAdd]
    addTown = towns[randAdd]
    addState = states[randAdd]
    addZip = zips[randAdd]
    
    phoneNum = phonenumbs[randAdd]
    email = (fname + lname + "@" + compName.replace(" ", "") + ".com")

    #print("Streets: " + str(stNums))
    print(custID + " " + compName.title() + " " + phoneNum + " " + email.lower() + " " + addStreet + " " + addTown + ", " + addState + " " + addZip)

    buisnessInfo.append(custID)
    buisnessInfo.append(compName.title())
    buisnessInfo.append(phoneNum)
    buisnessInfo.append(email.lower())
    buisnessInfo.append(addStreet)
    buisnessInfo.append(addTown)
    buisnessInfo.append(addState)
    buisnessInfo.append(addZip)

    #print(buisnessInfo)

    return buisnessInfo
    
        
def exitProgram():
    #print("\n*****Exiting Program!******")
    #time.sleep(2)
    print("\nProgram Has Finished Successfully!")

main()


