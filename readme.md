# Ovia Incentives Program Management App

This is a WordPress plugin designed to manage employer incentive programs to award users of Ovia apps. Events are sent to this backend as users interact with the Ovia apps and then those events are processed in order to qualify users for awards.

## Contributing

This plugin utilizes the MWP Framework. To contribute to its development, begin with the documentation here:
* [Installation & Setup](https://www.codefarma.com/docs/mwp-framework/setup/)
* [Clone A Plugin](https://www.codefarma.com/docs/mwp-framework/setup/clone-plugin/)

## Architecture

### Models

The following classes are used for persisting data within the app.

* [User](/classes/Models/User.php) - A known user of Ovia apps
* [Employer](/classes/Models/Employer.php) - An employer who is eligible to use incentive programs
* [EmployerProgram](/classes/Models/EmployerProgram.php) - A record that ties an incentive program to an employer
* [UserAward](/classes/Models/UserAward.php) - A record used to track the award progress for a user in an employer program


### Domains

The following classes are used for extending the domain logic within the app.

* [AbstractProgram](/classes/Programs/AbstractProgram.php) - The base class and interface used for creating new programs in the system
* [AbstractAward](/classes/Awards/AbstractAward.php) - The base class and interface used for creating new awards in the system