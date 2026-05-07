
const MongoClient = require('mongodb').MongoClient;
const url = "mongodb+srv://Sfarrington:Br00kl1n@cluster0.hfopzip.mongodb.net/?appName=Cluster0";
var readline = require('readline');
var fs = require('fs');

//Creates an object to hold all the places and their zipcodes
var placeList = {};

var myFile = readline.createInterface({
    input: fs.createReadStream('zips.csv')
});

// opens the file, reads it by line, and stores the places and their associated zips
// in the placeList
myFile.on('line', function(line){
    
    //splits each line at the comma and stores the parts in variables
    var placeInfo = line.split(",");
    var place = placeInfo[0];
    var zip = placeInfo[1];

    // if the place doesnt exist in placeList, adds it to placeList with the place and pushes 
    // its zip to the place's zip array. If it does already exist, pushes the 
    // additonal zip to the place's zip array
    if(!placeList[place]){
        placeList[place] = {place: place, zips : [zip]};
        console.log(place + " added to the database with the zip " + zip);
    } else{
        placeList[place].zips.push(zip);
        console.log("Added " + zip + " to " + place);
    }
})


myFile.on('close', function(){

    // converts the places object to an array to prevent an InvalidArgumentError
    placeArray = Object.values(placeList);

    MongoClient.connect(url, async function(err, db) {
        if(err){
            return console.log(err);
        }else{
            var dbo = db.db("cs120");
            var collection = dbo.collection('places');

            await collection.insertMany(placeArray, function(err, res){
                if(err){
                    console.log(err)
                }else{
                    console.log("Insertion into database successful");
                }

                db.close();
            });
        }
    }); 
});
