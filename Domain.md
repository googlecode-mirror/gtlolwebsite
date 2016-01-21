## Layered Architecture ##

The classes for the website are organized into a layered architecture:

  * Application (ie the website)
  * Controllers
  * Domain
  * Infrastructure (functionality that is not part of the domain logic)

Classes in a layer may not use classes in a layer above them, but they may use classes in a layer beneath them.

## Controllers ##
Controllers prevent the application from doing invalid operations with the domain. The application should not know about the model. The controllers should not contain any business logic.

## Domain File Structure ##

The domain is organized into the core and other subdomains. A sublayer in the domain is the data-persistence layer (ie. the repositories). A repository should make it seem like the domain objects exist in memory. This sublayer may be accessed by applications outside of the domain.