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
            ...
        ]
    }
}
```

Trigger Types | Value to display on GUI | Hint on hover
---------|----------
 "Text" | Text | Trigger for text messages sent by the user
 "DictionaryVariable" | Per-user variable | Trigger for values associated with this user
 "SingleVariable" | Global variable | Trigger for global values defined on the bot
 "Image" | Image | Trigger for image messages

 Text Trigger Modifier | Value to display on GUI | Hint on hover
---------|----------
 0 | "Evaluate regex pattern" | 

 Dictionary Variable Trigger Modifier | Value to display on GUI
---------|----------
 0 | "Compare the received text message to the user variable's current value"
 1 | "Compare a preset value to the user variable's current value"
 2 | "Check if user has an entry on this variable"

 Single Variable Trigger Modifier | Value to display on GUI
---------|----------
 0 | "Compare data to the user variable's value"
 1 | "Check if user has an entry on this variable"

 Image Trigger Modifier | Value to display on GUI
---------|----------
 0 | "