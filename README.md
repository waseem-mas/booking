I review complete code and there is a lot of space for code improvements to make it more manageable and scalable. Due to time shortage I only convert index function of BookingController so that you guys at least get idea about my approach and way of working. 
I Created new file named NBookingController and NBookingRepository where I only convert Index function, To review my code you have to open these two files.

Over all feedback I will explain here.
1)	For admin users instead of using ISSET too much we have to go with filter approach, due to which code becomes cleaner and manageable, I already attached filter folder and files for jobs. Currently I put only feedback and similarly we can add more filters.
2)	Regarding user roles we have to use Laravel roles and permissions package which provides cleaner interface to manage user roles
3)	For conditional queries we can use laravel eloquent when function instead of if else.
4)	We can use services to put less load on repositories and controllers and will achieve more separation of concern as well.
5)	Instead of php mailer we should go with laravel Mail feature.
6)	Instead of Events we can use Jobs as better use case for events is Real Time notifications, If we have to broadcast some thing real time then we have to use Events, for normal asynchronous tasks Jobs is better solution.
7)	For api responses we have to use standard generic response format for whole application, as I added one trait name GlobalResponseTrait in my demo code.
8)	We have close our main controller function in proper try catch block, where we have to maintain centralize Log file in case of errors, instead of code breaking exceptions to users

These are highlighted details, further we can make further improvements by proper separate code on the basis of separation of concern in multiple files instead of only Controllers and repositories. As of time shortage and my busy schedule this what I did at very abstract level so that you guys can get atleast some idea about my way of working and code management.
