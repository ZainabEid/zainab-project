# Zainab Project :
Roqay Training first project

## 1st Tasks [Sunday 29/5/2021]: __expected time 3h-4h taken time: 2h 5m__
1. use laravel 8 [DONE]
2. add admin LTE for homepage and login form [DONE]
3. multi auth Admin/User using bmatovu/multi-auth [DONE]
4. login as admin [DONE]

## 2nd Task [Monday 30/5/2021]: 
1. Localization: __expected time : 2h taken time: 1:30__
    1. npm install rtl css [Done]
    2.  in layout choose the rtl file if ar [Done]
    3. in body set direction to rlt in ar [Done]
    3. add lang button to dashboard [Done]  ===> middleware to set local [Done]
2. category table [Done]  __expected time : 2h, taken time: 8h__
    1. add link to aside [Done]
    2. category model , migration, seeder [Done]
    3. crud controller for category
        - create [Done]
        - read [Done] => __issue:__  [in model photo isn't a path !, in index path correct but no photo ]
        - update  => use the laravel collective included form [Done]
        - delete [Done]
## 3rd Task [Tusday 1/6/2021]
3. make the Admin table with roles and permittion __expected time 5h, taken time:9h__
    - admin crud [Done] 
    - install spatie [Done]
    - reed documentation [Done] 
    - roles permission seeder [Done]
    - create admins role [Done] 
    - create super admin role [---]
    - attache roles to created admin [Done]
    - crud roles and permission [Done]
## 4th Task [Wednsday 2/6/2021]
4. One page for user crud with ajax __Expected time: 5h__
    - user has name, mail, pass, photo, many phones
    - add new user button opens form in same page
    - add more than one phone number
    - save new user updates the table in the same page
    - each user detail is editable in its place
        
## 5th Task [Thrusday 3/6/2021]
5. news table
    - read: "Repository pattern" in laravel
    - make news tabel [title-ar , title-en, description, photo, admin_id]
    - make main repository and main reository interface
    - 