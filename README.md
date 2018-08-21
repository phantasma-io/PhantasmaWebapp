# SuperbotWebapp

The Superbot webapp should be a GUI that allows for local user-friendly manipulation of JSON documents with a known structure, downloading and uploading them via HTTP requests to a predetermined endpoint.

## Trigger groups

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

A trigger group consists of:

Property Name | GUI element name | User input rules | JSON output rules
-|-|-|-
trigger group name | Trigger Group name | Freeform text input | Must be same as user input
privateTrigger | Trigger chat type | Dropdown list:<br>- For all chat types<br>- For public chat only<br>- For private chat only | Respectively:<br>- null<br>- false<br>- true
triggers | Triggers | Some sort of list with several columns for each entry perhaps.. not sure | Read next section | Read next section

### Trigger object

A trigger object consists of the following:

Property Name | GUI element name | User input rules | JSON output rules
-|-|-|-
triggerType | Trigger type | Dropdown list with Trigger types' GUI element names  | JSON output for the chosen trigger type
modifier | Trigger sub-type | Dropdown list with the GUI element names of the modifiers for the chosen _trigger type_ | JSON output for the chosen modifier
data | An object with a structure that depends on the trigger type, and sometimes also with the modifier | Rules will be defined on a case by case basis
subgroup | An optional string, no input rules | Text input box | Same as the user input
onFailMsg | An optional string, no input rules | Text input box | Same as the user input

### Trigger types

GUI element name | Hint (i.e. on hover or whatever) | JSON output
-|-|-
Text | Trigger for text messages sent by the user| "Text"
Per-user variable | Trigger for values associated with this user | "DictionaryVariable"
Global variable |  Trigger for global values defined on the bot | "SingleVariable"
Image | Trigger for image messages | "Image"

### Text trigger type modifiers

GUI element name | Hint (i.e. on hover or whatever) | JSON output
-|-|-
Regex | Evaluates if the text message contains the defined regex pattern. To learn the relevant regex syntax go to https://docs.microsoft.com/en-us/dotnet/standard/base-types/regular-expression-language-quick-reference | 0

### Per-user variable trigger modifiers

GUI element name | Hint (i.e. on hover or whatever) | JSON output
-|-|-
User message | Compare the received text message to the user variable's current value | 0
Preset value | Compare a value defined by you to the user variable's current value | 1
Entry check | Check if user has an entry on this variable | 2

### Global variable trigger modifiers

GUI element name | Hint (i.e. on hover or whatever) | JSON output
-|-|-
User message | Compare the received text message to the user variable's current value | 0
Preset value | Compare a value defined by you to the user variable's current value | 1

### Image trigger modifiers

GUI element name | Hint (i.e. on hover or whatever) | JSON output
-|-|-
Size check | Check if an image's size is between a defined range | 0

### Trigger user stories

The UI should enable the following user stories:

- As a user I want to view all existing trigger groups
- As a user I want to create a new trigger group
- As a user I want to edit any field of an existing trigger group
- As a user I want to reorder an existing trigger group among other trigger groups
- As a user I want to delete an existing trigger group
- As a user I want to view all existing triggers of a selected trigger group
- As a user I want to add a new trigger to the trigger group
- As a user I want to edit any field of an existing trigger in a trigger group
- As a user I want to reorder an existing trigger among other triggers inside a trigger group
- As a user I want to delete an existing trigger inside a trigger group
