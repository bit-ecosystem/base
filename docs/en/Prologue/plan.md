To create a Laravel app to do an end to end employee lifecycle
App would start with
1.  A department manager drafting and requesting for a manpower resource.
	Manpower resource template would contain details to a job position with its flexible properties/attributes.
	DB table would be like 
		Job Post table with job title, user, Description and reporting to (a parent Job title)
		Job Post sourcing with Job Post status, posting type (internal or external), posting end date.
		Job Post Property table with job title id, key and name (ie. key = skills, name = Laravel)
2. The request would go thru an approval flow, approx. 2 to 3 approval layers (ie. person holding reporting To title, then the HR Director, then Company President)
	Remains to be a draft till approval completes either approved to denied/cancelled
3. Approved request Job Post is now vacant (user field is null). The is able to gets posted to a career webpage link (all vacant posts can be listed here). 
	Career webpage link shows internal and external vacant posts if auth user and external for guest/Socialite user.
4. Potential candidates can submit their CVs and details to apply for Job Post, login as Socialite user.
5. If potential candidate is to be offered, candidate can further complete employment form details.
6. On date of candidate joining as employee, Job Post table is updated with user id.

Roles and Permission
Permission can be set/given to users with certain role, or user of Job Post.
Most approval flow will be based on JobPost.user rather than user.

7. Employee at may be reassigned to a different Job Post during employment period. the different JobPost would have also gone thru flow #1-#3, and would populate the vacant position. The prior position becomes vacant.
8. All vacant positions may be changed to cancelled at any point of time.
9. Access level would be based on some key values of Job Post Property or user Property

App to ideally use Laravel 11 with Filament 3 with plugins (Socialite and Filament Shield
composer require dutchcodingcompany/filament-socialite
composer require guava/filament-knowledge-base
composer require guava/calendar
composer require joaopaulolndev/filament-edit-profile
composer require joaopaulolndev/filament-general-settings

composer require bezhansalleh/filament-shield

Socialite logins (GitHub, LinkedIn, Facebook, Google, TikTok) = guest users and potential candidates
User Registration (by invitation only) = initial start of employee, vendor, contractors
Socialite login (Keycloak) = employee
