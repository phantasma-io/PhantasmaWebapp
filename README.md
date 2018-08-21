# SuperbotWebapp

The Superbot webapp should be a GUI that allows for local user-friendly manipulation of JSON documents with a known structure, downloading and uploading them via HTTP requests to a predetermined endpoint.

## Trigger groups

A trigger group consists of:

Element Name | GUI element name | User input rules | JSON output rules
- | - |-
trigger group name | Trigger Group name | Freeform text input | Must be same as user input
privateTrigger | Trigger chat type | Dropdown list:<br>* 
A list of trigger objects

A trigger object consists of the following:

Element Name | GUI rules | JSON output rules
- | - |-
triggerType | Must correspond to a TriggerTypeEnum member name | Dropdown list
modifier | Must correspond to the value of an Enum member. The enum depends on the _triggerType_, so we only handle integers.| Dropdown list, content depending on _triggerType_
data | An object with a structure that depends on the trigger type, and sometimes also with the modifier | Rules will be defined on a case by case basis
subroup | An optional string, no input rules | Text input box
onFailMsg | An optional string, no input rules | Text input box

The UI should enable the following user stories:
* As a user I want to view all existing trigger groups
* As a user I want to create a new trigger group
* As a user I want to edit any field of an existing trigger group
* As a user I want to reorder an existing trigger group among other trigger groups
* As a user I want to delete an existing trigger group
* As a user I want to view all existing triggers of a selected trigger group
* As a user I want to add a new trigger to the trigger group
* As a user I want to edit any field of an existing trigger in a trigger group
* As a user I want to reorder an existing trigger among other triggers inside a trigger group
* As a user I want to delete an existing trigger inside a trigger group

Format:

```json
{
    "trigger group name":{
        "privateTrigger": true,
        "triggers": [
            {
                "triggerType": "TriggerTypeEnum",
                "modifier": int,
                "data": object,
                "subgroup": null/string,
                "onFailMsg": null/string
            },
            (...)
        ]
    }
}
```



Trigger Types | Value to display on GUI | Hint on hover
---------|----------|-
 "Text" | Text | Trigger for text messages sent by the user
 "DictionaryVariable" | Per-user variable | Trigger for values associated with this user
 "SingleVariable" | Global variable | Trigger for global values defined on the bot
 "Image" | Image | Trigger for image messages

### Text trigger modifiers

 Text Trigger Modifier | Value to display on GUI | Hint on hover
---------|----------|-
 0 | "Evaluate regex pattern" | 

### Dictionary variable trigger modifiers

 Dictionary Variable Trigger Modifier | Value to display on GUI
---------|----------
 0 | "Compare the received text message to the user variable's current value"
 1 | "Compare a preset value to the user variable's current value"
 2 | "Check if user has an entry on this variable"

### Single variable trigger modifiers

 Single Variable Trigger Modifier | Value to display on GUI
---------|----------|-
 0 | "Compare data to the user variable's value"
 1 | "Check if user has an entry on this variable"

### Image trigger modifiers

 Image Trigger Modifier | Value to display on GUI
---------|----------|-
 0 | "