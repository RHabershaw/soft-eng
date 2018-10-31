import os
import random
import string

def main():
    print("Running Main\n")
    
    file = open("AddressNames2.txt","w")

    lines = [line.rstrip("\n") for line in open('AddressNames.txt')]

    #print(lines)

    count = 1
    temp1 = ""
    temp2 = ""
    test = ""

    for line in lines:
        if count == 1:
            temp1 = line
            
            file.write(temp1 + "\n")
            
            count +=1
        elif count == 2:

            temp2 = insert_str(line, ",", -6)
            file.write(temp2 + "\n")
            count+=1
        else:
            file.write("\n")
            count = 1
            

     
    file.close()

    print("Temp1: " + temp1)
    print("Temp2: " + temp2)

    print("Finished!")

def fix():
    lines = [line.rstrip("\n") for line in open('moreadress.txt')]

    file = open("moreadress2.txt","w")

    count = 1
    temp = 0

    for line in lines:
        if count == 1:
            temp1 = line
            
            count +=1
        elif count == 2:

            temp2 = insert_str(line, ",", -6)           
            file.write(temp1.lstrip() + "\n")
            file.write(temp2.lstrip() + "\n")
            count+=1
        elif count == 3:
            file.write("\n")
            count += 1
            temp +=1
        else:
            count = 1

    print(str(temp))        
    print("Finished!")

def test2():
    lines = [line.rstrip("\n") for line in open('sizes.txt')]
    file = open("sizes2.txt","w")


    #count = 1

    for line in lines:
        file.write("'" + line + "',\n")

    file.close()        
    print("Finished!")

    
def insert_str(string, str_to_insert, index):
    return string[:index] + str_to_insert + string[index:]

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

def generateBuisness():

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
    compName = compnames[random.randint(0, compNum)]

    count = 1
    
    for line in address:
        if count == 1:
            addStreet = line
            
            streets.append(addStreet)
            
            count +=1
        elif count == 2:
            print(line.split())
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
    
    phoneNum = phonenumbs[random.randint(0, pNums)]
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

    print(buisnessInfo)

    return buisnessInfo
    

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

def test():
    #lines = [line.rstrip("\n") for line in open('VendorCodes.txt')]

    f = open('VendorCodes.txt')
    for word in f.read().split():
        print(word)

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
    

def test3():
    file = open("Goods.sql","r")

    goods = []
    count = 0

    lines = [line.rstrip('\n') for line in open('Goods.sql')]
    del lines[-1]

    for line in lines:
        if """('""" in line:
            stored_line = (line[2] + line[3] + line[4] + line[5] + line[6] + line[7] + line[15])
            goods.append(stored_line)
            print (stored_line)
            count += 1

    print (count)    
    file.close()

    return goods
    

#generateBuisness()
#generateCustomer()
#main()
#test2()
#test3()
#fix()
#orderEntryCustomers()
#checkCustomer()
generateOrders()
