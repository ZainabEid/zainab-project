## css and script files need to be from the root
- use / before the path or use asset()
- use public path adnd store function to store photos 
- 

## Auth packages:
- laravel ui
- laratrust : roles and permission like spatie
- jetstream -|
- fortify    |- laravel one guard auth
- breeze    -|
- bmatovu : mutli guards auth
- hesto : mutli guards auth

## rtlcss is a tool tha changes style direction of any file from left to right

## laravel collective is manipulate html forms fast and easy

## hyperv : is microsoft virual machine to run multi os on same computer

## in js: use formData or home

## localization steps manually:
1. use rtl css to change the files dir to rtl
2. set the dir in body tag
3. in controller change_lang($locale){App::setLocale($local); session()->put('locale',$locale);return redirect()->back;}
4. localization middleware:handle(){if(session()->has('locale'){App::setLocale(session()->get('locale'))} return $next($request))}
5. add middleware to kernel's middlewareGruops 


## spatie package for roles and permissions look at laravel gate in security/auth to full understand
1. composer insatall the package
2. publish the migration
3. config:clear , migrate
4. solve the long lenth error by adding  Schema::defaultStringLength(125); in AppServiceProvider boot() 
5. 

## crud user with ajax all in the same page use socialize() or Formdata() to get all data from the form in one line
1. make users/index view that shows table of all users[Done]
2. make add-new user form in add_new_user.blade.php[Done]
3. append the form in the users/index using add new user button[Done]
4. in the appended form use plus button to add an additional phone field [DONE]
5. save the user to db and show it in the table __expected time 8h, taken time: 8h 20m +5h__
    - in js: onSubmit prevent default and recive data [url, method, name, mail,pass, phones[], photo] [Done]
    - send data with ajax to the users.store route [Done]
    - apply data verification and send to controller [phone-verification-remains] 
    - in controller: save data to database and return json message with the same data [DONE]
    - in js: in ajax success append data to users-table.[Done]
    - cancel form js function clear the form place and activate the add user button[Done]
    - phones new buttons should include remove link[Done]
    - adding new user to users tabel[DONE] __index remains__
6. each user details is editabe 
    - in users.index view: each name field has a edit-button  [Done]
    - on click append _one_input_form to the closest parent [not-appending]
    - validate the new data
    - submit the edited data and save it to db
    - show the new value
7. delete the user[Done]
   

__ask__
migration droped the column with all data

## in js : check if there is an file:
on('click', funciton(e){
    e.preventDefault();
    let check = isImageUploaded();
    if(check){
        // add form to form data and go on
    }
});

funciton isImageUploaded(image){
    let check = true;
    let file =$('.image').get(0).files[0];
    if(file == undefiend || file == null){
        check =false;
         $('#error_image').show();
        return check;
    }else{
         $('#error_image').hide();
         return check;
    }
}
## file api to get image preview !!!

## packages for redirect back 
    - toester
    - sweet ajax

## chrome extention : fill this to auto fill the form