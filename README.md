web-app
=======
# Ottawa For Families

Ottawa For Families is a fun and easy to manage application that allows users to find family oriented  locations or events in Ottawa. It is oriented to all families with children. It is accessible for mobile devices and also desktops. 

Data sources: 

- [Ottawa Open Data](http://ottawa.ca/online_services/opendata/)
- [Eventbrite](http://www.eventbrite.com/)

### Features

-	Displays all the family oriented city locations as well as public events on a list.
-	Information displayed is for a specific date.
-	Locations and events are organized by categories.
-	Colored icons for different categories, rates, cost (free or paid).
-	Colored time bar for each location/event. The length of each bar depends on the time that the location/event is available or lasts during the day.
-	Detail information for each location or event selected: Duration, for how long, contact info, and location on a map.
-	Ability to input the date to access locations/events available.

## Learning Goals

-	Learn how to deal with Open Data and other data sources.
-	Learn more about jQuery and PHP programming as well as databases.
-	Apply accessibility and responsive design concepts previously learned and learn more about them.
-	Learn about using Google Maps for building web applications
-	Use and learn more about developement and post-launch tools (i.e Visual Event, Javascriptcompressor, JSHint, CSS Compressor)

The makings of this application will be an interesting challenge. Not only I will apply previous learned concepts but also I will acquire new ones in a short period of time. The most exciting part is the fact that it will be something real that can be used by many people today. 

### Technologies & techniques

-	Mobile first and responsive web design.
-	Google Maps API.  
	PHP, because it is the most popular language used to write web applications and also because there is good documentation.
-	PHP on Google App Engine via a version of Quercus. Since Google App Engine offers automatic scaling for web applications I won't have to worry about managing machines if my app's traffic and data storage grow.
	Python, as the other alternative, because it's a popular language with excellent readability that encourages elegant code. Python is used as the main programming language of Google.
-	MySql.

## Similar Applications

1.	[Ottawa For Kids] ( http://www.ottawaforkids.webs.com/)
	
	Ottawa for kids uses a map to display places to have fun in Ottawa. It includes the tabs activities, leisure and sports. Selecting one of these tabs displays subcategories that once clicked display a map with circle icons representing the location of these places. Selecting the icons of the map presumably provides directions and more details, but at the time of writing this proposal this feature does not work.
	
	It uses City of Ottawa Open data sources.

	**Differences**

	My app will display the locations/events to have fun in a list along with the time that those events are available, like an agenda. It will also rate the activities and tell if the activity is free or not by using icons. A map will be displayed when selecting a specific location/event.  
	It will use City of Ottawa Open data as well as data from businesses.
	
2.	[OttawaInsideOut](http://www.ottawa-events.ca/Download.html)

	This is an Android app. The information is organized by sections. Events can be searched by date or category and there is the option on how the results can be displayed: in a list or a map. 	
	Events can also be found by location (i.e. specific neighbourhood) using the phone�s GPS. Details of the event include: cost, times, location, contact phone number and a link to the website. 
	
	Similar to events, the locations of museums, parks, sports and recreational information is displayed in a list or a map.

	Other features include the directions function and StreetView function.
	
	Some information displayed is in French.
	
	This is a very thorough app with many detailed features many of them displayed at once on a page. It�s a bit overwhelming.

	**Differences**
	
	It is only available for android devices CHECK THIS SAY IT IN OTHER WORDS??. My app will be accessible for mobile devices and desktops. 
	It has some features I will include, i.e. display data by date and category. 
	The scope of my web app is narrower: It�s targeted to families with children. It will display all the events on a list only and is in English.

3.	[OttawaFun](http://www.ottawafun.ca/)

	This web app displays on a list Ottawa public locations such as museums, pools, parks and others. The list displays one category at a time. Next to the list, a map displays all the locations of that category.  
	
	Selecting a location on the map displays a label with address detail and links for writing a review and to get directions.
	
	**Differences**
	
	My app will include not only Ottawa public locations but also events for families.
	It will not display all the loctions/events on a map. The map option will be shown for one specific location/event selected.

4.	[Ottawa Events](http://itunes.apple.com/ca/app/ottawa-events/id410644884?mt=8)

	Is a free app for iPhones and displays events happening in the city on a list. Once the event is clicked the event is shown on a map with an icon and a label on top. Details of the location are shown after touching the label. It uses different data sources including the City of Ottawa.

	**Differences**
	
	My app will be showing events on a list as well, but the scope is smaller since it will include only family events. Another difference will be that events will be rated and there will be additional icons to show if the events is free or not. My app will be a web app.

## User Research
	
Ottawa For Families is oriented for families with children who live or visit Ottawa and who have access to mobile devices or desktops.
	
There are many apps that provide info about Ottawa public locations and the events happening in Ottawa but there aren�t too many specific for families with children.
	
With this app, families can find locations/events quickly, in an organized manner and spend a fun day.

### Hos-Domenech Family
	
![Hos-Domenech Family](www.Hos.ca)

The Hos-Domenech Family is made up by Norma, Bart and their children David (7 years old) and Sophia (5 years old).

Norma is a public servant who works at Infrastructure Canada as a Policy Analyst. She has been employed in the public sector for over 12 years. Bart is a software developer who works for Ciena Technologies. He has been involved in the high technology industry since he graduated as an Electrical engineer and has worked for different private companies.

The Hos-Domenech family manage a very hectic schedule during the week, as Norma and Bart work on a full-time basis. As such, there is little time for planning activities ahead of time, especially on the weekends. 

Activities with the kids during weekends are mostly weather-dependent. 	

The Hoss-Domenech family:

-	Like doing things in the spur of the moment, if the scheduled activities allow the family to do so.
-	Is active. In the winter, the whole family enjoys time outside skiing, skating, tobogganing. The children also take swimming lessons, piano lessons and ballet.
	In the summer, outdoor activities change to soccer, biking, tennis, or simply playing in the park with friends from school.
-	Is musical, Bart composes and records music. He also enjoys playing piano and guitar. Little David and Sophia are taking piano lessons. Norma enjoys dancing and listening to music.
-	Likes entertaining and to go out.
-	Is computer literate. Norma enjoys digital photography and has mastered a number of photo editing software to work with her photographs. Bart's hobbies include building websites for personal and business uses.
	Norma and Bart, both, have access to mobile devices.

#### Motivations for using the app

-	Having up to date and quick access to locations and events specifically for families when they spontaneously decide to go out is very convenient.
-	The Hos-Domenech believes that family time is very important and wants to do activities together.
-	Entertaining kids at home a good part of the day is not always easy. Going out with the children makes their day go by faster.
-	The kids get bored if spending too long in the house and need to spend their energy doing something fun, out of the ordinary.
-	Learning while having fun, going out.

#### Demotivations for using the app.

-	If the app is slow.
-	If the app is poorly accessible.
-	If the app displays inaccurate or outdated info.
-	Other issues not related to the app: Unable to go out (i.e. weather conditions, sickness, work, etc)