function chooseMeeting() {
    var meetType = prompt("What type of meeting do you want?\nOptions: Normal Meet, Coffee Meet, Talk about work or job");

    if (!meetType) return;

    var choice = meetType.trim().toLowerCase();

    if (choice === "normal meet") {
        alert("I will connect with you Soon");
    } else if (choice === "coffee meet") {
        alert("Let me know about your discussion topic by sending email on: rakibss974@gmail.com");
    } else if (choice === "talk about work or job") {
        var topic = prompt("Wanna talk about which topic?\nOptions: Projects, Research, Web developing");

        if (!topic) return;

        var subChoice = topic.trim().toLowerCase();

        if (subChoice === "projects") {
            alert("Let's discuss about the project on phone: 01947853732");
        } else if (subChoice === "research") {
            alert("Send me your research topic with your personal informations on my website given email");
        } else if (subChoice === "web developing") {
            alert("Send me the plan layout or design of your web in Personal email: 22-49029-3@student.aiub.edu");
        } else {
            alert("Invalid topic choice.");
        }
    } else {
        alert("Invalid meeting type.");
    }
}

chooseMeeting();