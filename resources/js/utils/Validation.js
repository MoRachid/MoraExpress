export default class Validation {
    
    constructor()
    {
        this.messages = {}
    }

    getMessage(field)
    {
        if(this.messages[field]) {
            return this.messages[field][0];
        }
    }

    setMessage(messages)
    {
        this.messages = messages;
    }

    empty() 
    {
        this.messages = {};
    }
}