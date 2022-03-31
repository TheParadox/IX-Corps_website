# IX-Corps Website

While the repository is set to public - this IS **NOT freeware**. If you want a similar site, or to use this for your group, please message me.

## IX-Corps website overview:
The purpose of this website is to assist with and help facilitate the tracking and storing records for members of the War of Rights gaming group known as 'IX-Corps' within a single system. The site overall, aims to reduce the number of different OneDrives and Google sheets used to track all the members, awards, and events. Thus reducing paperwork and the chances that members are not properly awarded/credited for any achievements that they may have earned within the community. It should be noted that the project is still a work in progress and not all features have either been designed, implemented or even considered yet. As well, currently implemented features are subject to change based on the requirements of future features.

### Features:
 - Users/Members: can be 'enlisted' (registered and active), 'discharged' (deactivated account), updated, and transfered between units. As it stands, to create a new member; an existing member with sufficient permissions must be the one to create it. There is no 'register here' page for the general public - as a security measure.
 - Units (Regiment & Company): can be created, deactivated, reactivated and modified as needed.
 - Ranks and Positions: Not only created, activated, deactivated and modified, but can also have duplicates for specific roles and required permissions
 - Permissions: set up for a military style structure to ensure only those with the right permissions can approve or create stuff.
 - Accolades/Awards: can be created, assigned or 'nominated' to users for various actions within the game or community 
 - Nominations (promotion/demotion, awards, position): used to change a members rank, position within a unit or give them awards - can be approved OR denied
 - Unit transfers: Sometimes members move between units 
 - Schedule/Calender: In order to ensure everyone knows when to show up and what is happening when
 - Event Results Tracking: tracking the results of matches can give a preview of areas that might need improvement.

### Users Manual:
Work in-progress.

## Viewing the code:
**WHILE the project is not freeware**, if you are new to laravel - take a look around to see how some of the features work. It should be noted that the database connections files are not included, for security reasons.

### URL Routing:
Can be located in the "routes/web.php" file. 

### Data Models:
The models can be found under the "App/Models" folder. Whereas the migrations can be located in the "database/migrations" folder.

### Views:
All views can be found within the "resources/views" folder. From there they are broken down by function. Early pages where tossed into folders (pages/processing/unit folders) without much consideration for naming or organization, as such they are subject to change. A naming convention is still being worked on and as time goes on the pages and functions will be renamed, still trying to determine the simplest, easest to navigate + understand convention.

 #### Folders (alphabetical):
  - auth: views that deal with authorization, such as login
  - editing: contains views used in the editing of regular information, such as member data, companies, regiments, ranks, etc...
  - layouts: the page templates for how the site should be layed out.
  - NominationEditing: nothing at the moment
  - nominations: the views and forms relating to the 'nominations' processes; naming and organization needs to be made a little clearer
  - pages: pages designed to be viewed by the general public, such as the landing page, the units, event results, etc...
  - processing: All forms - used to create new items: award, company, member, rank and regiment
  - unit: poorly named... contains the 'specific' views for: award, company, individual, rank and regiment.

### Controllers:
Are in the "app/Http/Controllers" folder. The controllers themselves are named nearly identically to the views they are linked to, the folder the controller is in is named the same as its view. Thus, if you are looking for the controller for the Ranks page (located in "resources/views/pages" folder), look in the "app/Http/Controllers/pages" folder. Currently debaiting if like controllers should be merged together. i.e., if it has anything at all to do with awards it goes into the AwardsController.

### Integration:
This is designed as a stand-alone website. As such it is not designed to nor has any functionality for integrating into another project.

### Production servers:
As this project is not intended to be used by just anyone that finds the github page - no instructions for either of these are included. Even though they are easy to find.

### Components used:
Web library: Laravel (PHP)
CSS: Tailwindcss
Database: MySql

Google spreadsheets integration will be investigated in the future as possibly a backup database, or to use data currently entered - to reduce re-entry of some data.


#### To-Do List:
