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
* [EmployerProgramAward](/classes/Models/EmployerProgramAward.php) - A record that assigns an award to an employer program
* [UserProgress](/classes/Models/UserProgress.php) - A record used to track progress for user in a given program
* [UserAward](/classes/Models/UserAward.php) - A record used to assign an earned award to a user for a completed program

### Domains

The following classes are used when extending the domain logic for programs and awards.

* [AbstractProgram](/classes/Programs/AbstractProgram.php) - The base class and interface used for creating new programs in the system
* [AbstractAward](/classes/Awards/AbstractAward.php) - The base class and interface used for creating new awards in the system

## System Usage

Once the plugin is installed to the backend, a new endpoint becomes available to send events to. 

`POST {site_url}/wp-json/ovia/v1/events` - The posted data is of type `Content-Type: application/json` and has the following parameters:
* `user_id` - The id of the user which the event is being tracked for
* `event` - The event data payload (json object). Below is a sample events payload:

```
{
	"user_id": "abc123",
	"event": {
		"type": "activity",
		"timestamp": 1636360037
	}
}
```

### Backend Design

* A `User` should be associated with an `Employer` in order to participate in programs. 
* An `Employer` can have one or more registered programs associated with them via the `EmployerProgram` record.
* An `EmployerProgram` can have one or more registered awards associated with it via the `EmployerProgramAward` record.
* An incentive program will track the progress of a given user through the program objectives via a `UserProgress` record.
* When a user completes all program objectives, an award is given to the user which is represented by a `UserAward` record.

#### Adding New Incentive Programs

An incentive program can be added to the system by extending the `Ovia\Incentives\Programs\AbstractProgram` class. The responsibility of your class is to process events that are received from the api and then track progress for a user through the program objectives. Once program objectives have been reached, the `processEvent` method of the implementing class should set the `$userProgress->status = 'complete'` so that any awards for the program will be granted.

After a new program is implemented, it must be registered to the backend using `$plugin->registerProgram()`.

#### Adding New Awards

An award can be added to the system by extending the `Ovia\Incentives\Awards\AbstractAward` class. The responsibility of your class is to perform the necessary system interactions that are needed to actually deliver the award to a user.

After a new award has been implemented, it must be registered to the backend using `$plugin->registerAward()`.