DocVer: 0.1.2

***not approved***


*For a more general ("high-level") understanding of where the information below fits into requirements analysis and the software development process in general, please see* ***[this article](http://en.wikipedia.org/wiki/Requirements_analysis)***

When editing this document, please do not remove the comments for each section which can be seen when editing (inside the lesser than and greater than signs) since these comments gives suggestions of how to write each section


# Software Requirements Specification for Empathy App

This document is based on a template with this copyright: "Copyright © 1999 by Karl E. Wiegers. Permission is granted to use, modify, and distribute this document."

### Revision History

See commit notes


## 1. Introduction


#### 1. Purpose 
<Identify the product whose software requirements are specified in this document, including the revision or release number. Describe the scope of the product that is covered by this SRS, particularly if this SRS describes only part of the system or a single subsystem.>

Software requirement specification (SRS) for Empathy App version 1.0


#### 2. Document Conventions
<Describe any standards or typographical conventions that were followed when writing this SRS, such as fonts or highlighting that have special significance. For example, state whether priorities  for higher-level requirements are assumed to be inherited by detailed requirements, or whether every requirement statement is to have its own priority.>

* If a future version is discussed this will be explicitly mentioned in this document. Otherwise version 1.0 is implicitly assumed
* ***Examples in this document are from the prototype we have at the time of writing, this doesn't mean that we need to use skype or other technologies shown in the examples***


#### 3. Intended Audience and Reading Suggestions
<Describe the different types of reader that the document is intended for, such as developers, project managers, marketing staff, users, testers, and documentation writers. Describe what the rest of this SRS contains and how it is organized. Suggest a sequence for reading the document, beginning with the overview sections and proceeding through the sections that are most pertinent to each reader type.>

The technical requirements may use some tech/nerd speech, for help please see [[Abbreviations and explanations]] in this wiki


#### 4. Product Scope
<Provide a short description of the software being specified and its purpose, including relevant benefits, objectives, and goals. Relate the software to corporate goals or business strategies. If a separate vision and scope document is available, refer to it rather than duplicating its contents here.>

Empathy app connects trained empathizers to people in need of empathy

Goals:
* Reaching many people over the world in need of empathy
* Building an alternative gift-economy through donations


#### 5. References
<List any other documents or Web addresses to which this SRS refers. These may include user interface style guides, contracts, standards, system requirements specifications, use case documents, or a vision and scope document. Provide enough information so that the reader could access a copy of each reference, including title, author, version number, date, and source or location.>



## 2. Overall Description

#### 1. Product Perspective
<Describe the context and origin of the product being specified in this SRS. For example, state whether this product is a follow-on member of a product family, a replacement for certain existing systems, or a new, self-contained product. If the SRS defines a component of a larger system, relate the requirements of the larger system to the functionality of this software and identify interfaces between the two. A simple diagram that shows the major components of the overall system, subsystem interconnections, and external interfaces can be helpful.>

**System overview:**

![product overview](https://cloud.githubusercontent.com/assets/10245688/5824611/fcb0d13c-a0e5-11e4-98d9-73242f0f6917.png)

The latest version of this document can be found [*here*](https://docs.google.com/drawings/d/1hgZ-0tdPJqmyoK4unhMS8gfTUU0RVf4LiA3CCMuaJuQ/edit?usp=sharing)


#### 2. Product Functions
<Summarize the major functions the product must perform or must let the user perform. Details will be provided in Section 3, so only a high level summary (such as a bullet list) is needed here. Organize the functions to make them understandable to any reader of the SRS. A picture of the major groups of related requirements and how they relate, such as a top level data flow diagram or object class diagram, is often effective.>
* Connecting callers with empathizers through the internet
* Enabling callers to donate money to Empathy App
* Storing information enabling calculation of how much money is going to each empathizer
* Storing information enabling understanding of user behavior

Possibly: Connecting callers with empathizers through the standard phone system

Also see *[this](https://docs.google.com/document/d/1_8-Cua7gF3qJ-RRYXt-lavWDeioxmVYAeJpJA6Q_l1k/edit?usp=sharing)* document written by Peijman


**Before call interaction:**

![before call](https://cloud.githubusercontent.com/assets/10245688/5824856/4dc8e568-a0e7-11e4-82f5-64ba1469ab0d.png)

**After call interaction:**

![after call donation](https://cloud.githubusercontent.com/assets/10245688/5824857/4de752a0-a0e7-11e4-85b2-4720b241e98c.png)

The latest versions of these images can be found *[here](https://docs.google.com/drawings/d/12hOU9pnb-KRPLXShBbNHLvM_t3rNvWtYTpedPNwzLm8/edit?usp=sharing)* and *[here](https://docs.google.com/drawings/d/11gqkzMLTLrfhNChdpXUX40kKZHw8PI5NVm6USfZCCME/edit?usp=sharing)*


#### 3. User Classes and Characteristics
<Identify the various user classes that you anticipate will use this product. User classes may be differentiated based on frequency of use, subset of product functions used, technical expertise, security or privilege levels, educational level, or experience. Describe the pertinent characteristics of each user class. Certain requirements may pertain only to certain user classes. Distinguish the most important user classes for this product from those who are less important to satisfy.>

User | Considerations
--- | ---
Caller | Ease of access to software, Minimal usage of the software itself ("counting mouseclicks"), Ease of making donations, Good "onboarding" experience
Empathizer | Ease of use
Administrator | Ability to collect call data, (Optional: Ability to change theme settings), Ability to change suggested donation multiplier (based on nr of minutes)


#### 4. Operating Environment
<Describe the environment in which the software will operate, including the hardware platform, operating system and versions, and any other software components or applications with which it must peacefully coexist.>

We want the software to work with a wide variety of platforms, but especially important is mobile phones


#### 5. Design and Implementation Constraints
<Describe any items or issues that will limit the options available to the developers. These might include: corporate or regulatory policies; hardware limitations (timing requirements, memory requirements); interfaces to other applications; specific technologies, tools, and databases to be used; parallel operations; language requirements; communications protocols; security considerations; design conventions or programming standards (for example, if the customer’s organization will be responsible for maintaining the delivered software).>

TODO (Not determined at the time of writing)


#### 6. User Documentation
<List the user documentation components (such as user manuals, on-line help, and tutorials) that will be delivered along with the software. Identify any known user documentation delivery formats or standards.>

* Callers: Interface is expected to be intuitive enough to not need a manual
* Empathizers: A guide for empathizers will be used, (an early version can be found on this wiki: [[Empathizer documentation]])
* Administrators: Low prio because of the small size of this group and the ease of access to knowledge in other ways (communication with developers)


#### 7. Assumptions and Dependencies
<List any assumed factors (as opposed to known facts) that could affect the requirements stated in the SRS. These could include third-party or commercial components that you plan to use, issues around the development or operating environment, or constraints. The project could be affected if these assumptions are incorrect, are not shared, or change. Also identify any dependencies the project has on external factors, such as software components that you intend to reuse from another project, unless they are already documented elsewhere (for example, in the vision and scope document or the project plan).>

TODO

Dependencies:
* Communication software
  * Presence information solution
* Javascript
* A server-side programming language and framework
* Payment/donation system
  * Ex: Stripe



## 3. External Interface Requirements


#### 1. User Interfaces
<Describe the logical characteristics of each interface between the software product and the users. This may include sample screen images, any GUI standards or product family style guides that are to be followed, screen layout constraints, standard buttons and functions (e.g., help) that will appear on every screen, keyboard shortcuts, error message display standards, and so on. Define the software components for which a user interface is needed. Details of the user interface design should be documented in a separate user interface specification.>

##### Caller interfaces

**Front page:**

![front_page](https://cloud.githubusercontent.com/assets/10245688/5825839/9f87324a-a0ee-11e4-9202-0ffea35fffa9.png)

**Registration:**

![registration](https://cloud.githubusercontent.com/assets/10245688/5825894/039a05be-a0ef-11e4-8585-897b92fdc5f4.png)

**Login:**

![login](https://cloud.githubusercontent.com/assets/10245688/5825893/0380ffc4-a0ef-11e4-8647-74f2cbb9533a.png)

**Communication interface:**

![communication_interface](https://cloud.githubusercontent.com/assets/10245688/5825943/6c11f282-a0ef-11e4-8694-54fc45146bae.png)

**Email message:**

![email_message](https://cloud.githubusercontent.com/assets/10245688/5825723/e016c6e6-a0ed-11e4-8e7c-dd4ddf8edce6.png)

**Donation message:**

![donation_form](https://cloud.githubusercontent.com/assets/10245688/5825607/f72eaaac-a0ec-11e4-88ab-0be95c708fef.png)



##### Empathizer interfaces

Registration and login interfaces as above, and also this:

**Email form:**

![email_form](https://cloud.githubusercontent.com/assets/10245688/5825606/f71744ac-a0ec-11e4-9f16-6aa19a2c4662.png)

(assuming as is the case in our prototype at the time of writing that the empathizer needs to do this manually and that we havn't found a way to fully automate this)


##### Admin interfaces

**Call records:**

![call_records](https://cloud.githubusercontent.com/assets/10245688/5826202/2c8dfb9a-a0f1-11e4-876f-2663a39d1a11.png)

**Settings:**

![settings](https://cloud.githubusercontent.com/assets/10245688/5826257/a9b8f3c2-a0f1-11e4-9d2f-921727e07ca1.png)


#### 2. Hardware Interfaces
<Describe the logical and physical characteristics of each interface between the software product and the hardware components of the system. This may include the supported device types, the nature of the data and control interactions between the software and the hardware, and communication protocols to be used.>

Supported device types:
* Mobile phones
  * Android
  * Iphone
* Desktop computers
  * Windows
  * MacOS

Screen layout constraints:
* 320 px min width


#### 3. Software Interfaces
<Describe the connections between this product and other specific software components (name and version), including databases, operating systems, tools, libraries, and integrated commercial components. Identify the data items or messages coming into the system and going out and describe the purpose of each. Describe the services needed and the nature of communications. Refer to documents that describe detailed application programming interface protocols. Identify data that will be shared across software components. If the data sharing mechanism must be implemented in a specific way (for example, use of a global data area in a multitasking operating system), specify this as an implementation constraint.>

Here is a list for our current prototype: [[External sw dependencies]]

Web browsers:
* TODO


#### 4. Communications Interfaces
<Describe the requirements associated with any communications functions required by this product, including e-mail, web browser, network server communications protocols, electronic forms, and so on. Define any pertinent message formatting. Identify any communication standards that will be used, such as FTP or HTTP. Specify any communication security or encryption issues, data transfer rates, and synchronization mechanisms.>

* SSL (HTTPS)



## 4. System Features
<This template illustrates organizing the functional requirements for the product by system features, the major services provided by the product. You may prefer to organize this section by use case, mode of operation, user class, object class, functional hierarchy, or combinations of these, whatever makes the most logical sense for your product.>


#### 1. Caller phone call to empathizer
<State the feature name in just a few words.>

##### 1. Description and Priority
<Provide a short description of the feature and indicate whether it is of High, Medium, or Low priority. You could also include specific priority component ratings, such as benefit, penalty, cost, and risk (each rated on a relative scale from a low of 1 to a high of 9).>

Ability for the "caller" user to call an empathizer

##### 2. Stimulus/Response Sequences
<List the sequences of user actions and system responses that stimulate the behavior defined for this feature. These will correspond to the dialog elements associated with use cases.>

Stimulus: None

Response: System finds an empathizer (if available) using a queue system as well as presence information, the call is then directed to this empathizer

##### 3. Functional Requirements
<Itemize the detailed functional requirements associated with this feature. These are the software capabilities that must be present in order for the user to carry out the services provided by the feature, or to execute the use case. Include how the product should respond to anticipated error conditions or invalid inputs. Requirements should be concise, complete, unambiguous, verifiable, and necessary. Use “TBD” as a placeholder to indicate when necessary information is not yet available.>

<Each requirement should be uniquely identified with a sequence number or a meaningful tag of some kind.>

* **PRE-1:** System gives presence information of the empathizer as online or offline
* **PRE-2:** System gives presence information of the empathizer as currently in a call or not in a call
* **COM-1:** System initiates a call between two people



#### 2. Email with donation link sent to caller
<State the feature name in just a few words.>

##### 1. Description and Priority
<Provide a short description of the feature and indicate whether it is of High, Medium, or Low priority. You could also include specific priority component ratings, such as benefit, penalty, cost, and risk (each rated on a relative scale from a low of 1 to a high of 9).>

An email that contains a message and a link to a donation page is sent to the caller after the call is completed. The link also contains information for setting the recommended donation amount

##### 2. Stimulus/Response Sequences
<List the sequences of user actions and system responses that stimulate the behavior defined for this feature. These will correspond to the dialog elements associated with use cases.>

Stimulus: End of call

Response: An email is sent to the registered email address of the caller

##### 3. Functional Requirements
<Itemize the detailed functional requirements associated with this feature. These are the software capabilities that must be present in order for the user to carry out the services provided by the feature, or to execute the use case. Include how the product should respond to anticipated error conditions or invalid inputs. Requirements should be concise, complete, unambiguous, verifiable, and necessary. Use "TBD" as a placeholder to indicate when necessary information is not yet available.>

<Each requirement should be uniquely identified with a sequence number or a meaningful tag of some kind.>

* **MSG-1:** System sends an email message with a donation link to the caller



#### 3. Donation from caller
<State the feature name in just a few words.>

##### 1. Description and Priority
<Provide a short description of the feature and indicate whether it is of High, Medium, or Low priority. You could also include specific priority component ratings, such as benefit, penalty, cost, and risk (each rated on a relative scale from a low of 1 to a high of 9).>

The caller gets a chance to donate an amount that is recommended, and can change this amount as well if she wants. Recommended amount is based on the length of the call, as well as a variable which can be set by an administrator

##### 2. Stimulus/Response Sequences
<List the sequences of user actions and system responses that stimulate the behavior defined for this feature. These will correspond to the dialog elements associated with use cases.>

Stimulus: Caller checking email inbox and clicking the donation link

Response: After the donation has been made, the caller is redirected to a "thank you" page

##### 3. Functional Requirements
<Itemize the detailed functional requirements associated with this feature. These are the software capabilities that must be present in order for the user to carry out the services provided by the feature, or to execute the use case. Include how the product should respond to anticipated error conditions or invalid inputs. Requirements should be concise, complete, unambiguous, verifiable, and necessary. Use "TBD" as a placeholder to indicate when necessary information is not yet available.>

<Each requirement should be uniquely identified with a sequence number or a meaningful tag of some kind.>

* **WEB-1:** System presents a web page with a donation form
* **WEB-2:** System presetns a web page with a thank you message




#### 4. Empathizer call info stored
<State the feature name in just a few words.>

##### 1. Description and Priority
<Provide a short description of the feature and indicate whether it is of High, Medium, or Low priority. You could also include specific priority component ratings, such as benefit, penalty, cost, and risk (each rated on a relative scale from a low of 1 to a high of 9).>

Call info is stored (for at least one month) so that the empathizer can get paid by the company (Empathy App) each month.

Call info we like to store:
* Identification of caller
* Identification of empathizer
* Length of call
* Amount donated by caller
* Time of call (more precisely: when it ended since this we can then gather all information at once)

Additional information we'd like to store for stastistical purposes (to help setting recommended amount in the future etc):
* Recommended donation amount that was presented to the user


##### 2. Stimulus/Response Sequences
<List the sequences of user actions and system responses that stimulate the behavior defined for this feature. These will correspond to the dialog elements associated with use cases.>

Stimulus: End of call

Response: Database updated so that information can be used in the future by administrators

##### 3. Functional Requirements
<Itemize the detailed functional requirements associated with this feature. These are the software capabilities that must be present in order for the user to carry out the services provided by the feature, or to execute the use case. Include how the product should respond to anticipated error conditions or invalid inputs. Requirements should be concise, complete, unambiguous, verifiable, and necessary. Use "TBD" as a placeholder to indicate when necessary information is not yet available.>

<Each requirement should be uniquely identified with a sequence number or a meaningful tag of some kind.>

* **DBC-1:** Store call info: Identification of caller
* **DBC-2:** Store call info: Identification of empathizer
* **DBC-3:** Store call info: Length of call
* **DBD-1:** Store donation info: Amount donated by caller
* **DBD-2:** Store donation info: Time when call ended
* **DBD-3:** Store donation info: Recommended donation amount that was presented to the user


## 5. Other Nonfunctional Requirements

#### 5.1 Performance Requirements
<If there are performance requirements for the product under various circumstances, state them here and explain their rationale, to help the developers understand the intent and make suitable design choices. Specify the timing relationships for real time systems. Make such requirements as specific as possible. You may need to state performance requirements for individual functional requirements or features.>

* **CON-1:** Max 1000 callers connected at the same time
* **CON-2:** Max 2000 empathizers connected at the same time
* **CON-3:** Max 10 administrators connected at the same time

(Version 2: These numbers will increase)

#### 5.2 Safety Requirements
<Specify those requirements that are concerned with possible loss, damage, or harm that could result from the use of the product. Define any safeguards or actions that must be taken, as well as actions that must be prevented. Refer to any external policies or regulations that state safety issues that affect the product’s design or use. Define any safety certifications that must be satisfied.>

TODO

#### 5.3 Security Requirements
<Specify any requirements regarding security or privacy issues surrounding use of the product or protection of the data used or created by the product. Define any user identity authentication requirements. Refer to any external policies or regulations containing security issues that affect the product. Define any security or privacy certifications that must be satisfied.>

* **SEC-1:** Caller email stored securely
* **SEC-2:** Empathizer call information stored securely
* **SEC-3:** User agreement to terms and conditions

Policies/regulations:
* PCI compliance (for credit card information)


#### 5.4 Software Quality Attributes
<Specify any additional quality characteristics for the product that will be important to either the customers or the developers. Some to consider are: adaptability, availability, correctness, flexibility, interoperability, maintainability, portability, reliability, reusability, robustness, testability, and usability. Write these to be specific, quantitative, and verifiable when possible. At the least, clarify the relative preferences for various attributes, such as ease of use over ease of learning.>

TODO


#### 5.5 Business Rules
<List any operating principles about the product, such as which individuals or roles can perform which functions under specific circumstances. These are not functional requirements in themselves, but they may imply certain functional requirements to enforce the rules.>

TODO

* Peijman: CEO
* Mica: COO
* Tord: Volunteer coordinator

#### 6. Other Requirements
<Define any other requirements not covered elsewhere in the SRS. This might include database requirements, internationalization requirements, legal requirements, reuse objectives for the project, and so on. Add any new sections that are pertinent to the project.>

TODO

Q: Will user information be transferrable from version 1 to version 2?



### Appendix A: Glossary
<Define all the terms necessary to properly interpret the SRS, including acronyms and abbreviations. You may wish to build a separate glossary that spans multiple projects or the entire organization, and just include terms specific to a single project in each SRS.>

See [Glossary and abbreviations](../glossary-and-abbreviations.md)


### Appendix B: Analysis Models
<Optionally, include any pertinent analysis models, such as data flow diagrams, class diagrams, state-transition diagrams, or entity-relationship diagrams.>


### Appendix C: To Be Determined List
<Collect a numbered list of the TBD (to be determined) references that remain in the SRS so they can be tracked to closure.>
