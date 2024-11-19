<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" href="/bag.ico" type="image/x-icon">
    <link rel="stylesheet" href="/css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <main>
        <div style="row-gap: 5px;display: flex; flex-direction: column; align-items: flex-end;">
            <!-- ADMIN VIEW -->
            <div style="cursor: default; display: flex; background: blue; font-size: 1.2rem; color: white; border: 1px solid; padding: 8px 14px; border-radius: 7px; flex-direction: row; flex-wrap: nowrap; justify-content: center; align-items: center; column-gap: 5px;"><span>Admin</span><img src="{{ asset('images/admin.png') }}" width="25px" height="25px" alt="admin"></div>
            <!-- ADMIN TABLE -->
            <table class="resume_table">
            <thead>
                <tr class="resume_header">
                    <th class="userid_header">ID</th>
                    <th class="picture_header">Picture</th>
                    <th class="firstname_header">Username</th>
                    <th class="usertype_header">Usertype</th>
                    <th class="status_header">Status</th>
                    <th class="action_header">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr class="resume_row">
                    <td class="userid_td">{{ $admin->userid }}</td>
                    <td class="picture_td">
                        <img src="{{ asset($admin->picture ? 'storage/' . $admin->picture : 'images/default_icon.png') }}" alt="user image" width="50px" height="50px">
                    </td>
                    <td class="username_td">{{ $admin->username ?? 'N/A' }}</td>
                    <td class="usertype_td">{{ $admin->usertype }}</td>
                    <td class="status_td">{{ $admin->status ?? 'N/A' }}</td>
                    <td class="action_td">
                        <button class="view-button" onclick="showModal('{{ $admin->userid }}')">View</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>

        <!-- ADMIN LOGOUT -->
        <button class="logout" onclick="logout()"><span>Logout</span><img src="{{ asset('images/logout.png') }}" width="20px" height="20px" admin="logout"></button>
        </div>




<!-- Modal Structure -->
<div id="modal" class="modal">
    <!-- MINI TOOLS -->
    <div style="display: flex; width: -webkit-fill-available; justify-content: flex-end; right: 7rem; position: fixed; z-index: 1;">
        <div style="background-color: #eeffba; width: fit-content; padding: 13px; border-radius: 0px 0px 10px 10px; display: flex; gap: 15px;">
            <!-- Edit Button -->
            <button class="edit-button" style="border-radius:7px;padding:10px;border: none; background:#cfcfff; cursor: pointer; transition: all 0.3s ease;" 
                    title="Edit" 
                    onmouseover="this.style.backgroundColor='lightgreen'; this.style.transform='scale(1.2)';" 
                    onmouseout="this.style.backgroundColor='#cfcfff'; this.style.transform='scale(1)';" 
                    onclick="enableEdit()">
                <img src="{{ asset('images/edit.png') }}" alt="Edit" style="width: 24px; height: 24px;">
            </button>

            <!-- Save Button -->
            <button id="saveButton" class="save-button" type="button" style="border-radius:7px; padding:10px; border:none; background:#cfcfff; cursor:pointer; transition:all 0.3s ease;" 
                    title="Save"
                    onmouseover="this.style.backgroundColor='lightgreen'; this.style.transform='scale(1.2)';" 
                    onmouseout="this.style.backgroundColor='#cfcfff'; this.style.transform='scale(1)';" 
                    onclick="saveChanges()">
                <img src="{{ asset('images/save.png') }}" alt="Save" style="width: 24px; height: 24px;">
            </button>
        </div>
    </div>

    <div class="modal-content">
        <span class="close-button" onclick="closeModal()">&times;</span>
        <h2 id="modal-title" style="text-align: left; margin: 0;"></h2>
        <!-- Output Message Container -->
        <div id="output_message" style="margin-top: 20px; padding: 10px; background-color: #f8d7da; color: #721c24; display: none;">
            <!-- This is where the success/error message will appear -->
        </div>

        <div id="modal-content">
            <!-- Modal Form (No <form> element here) -->
            <div class="paper">
                        <div class="col_1">
                    <!-- Hidden input field for the user ID -->
                    <input type="hidden" name="userid" id="userid">

                    <!-- Input field for fullname -->
                    <h1 id="fullname" style="text-align: center;" contenteditable="false"></h1>
            <div style="width: 100%; border: 1px solid;"></div>
            <h3 class="header3">RESUME OBJECTIVE</h3>
            <p id="objective" contenteditable="false"></p>
            <div style="width: 100%;  border: 1px solid;"></div>
            <h3 class="header3">PROFESSIONAL SKILLS</h3>
            <div class="professional_skills">

                <span class="add-skill" style="display:none;">[+]</span>
                <span class="remove-skill" style="display:none;">[-]</span>
                </div
            <div style="width: 100%;  border: 1px solid;"></div>
            <h3 class="header3">CERTIFICATIONS</h3>
            <p>UX & UI Design Certificate - Noble Desktop's Online Bootcamp - 2023</p>
            <p>Web Design & Development Certification - General Assembly's Immersive Bootcamp</p>
            <p>Interactive Design Certificate - California Institute of the Arts (CalArts)</p>
        </div>
        <div class="col_2">
            <img style="width: 200px; border: 1px solid; align-self: center;" src="{{ asset('images/users/reign.jpg') }}"  alt="Image">
            <br>
            <h3 class="header3 margin">CONTACT</h3>
            <p style="white-space: nowrap;"><span class="contact bold">Address:&nbsp;&nbsp;</span>B4 L1 Juniper St. Sabang Baliwag Bulacan</p>
            <p stle="white-space: nowrap;margin: 0;"><span class="contact bold">Phone:&nbsp;&nbsp;</span>09694894696</p>
            <p style="white-space: nowrap;margin: 0;"><span class="contact bold">Email:&nbsp;&nbsp;</span>202211361@btech.ph.education</p>
            <div style="width: 100%;  border: 1px solid;"></div>
            <h3 class="header3 margin">SKILLS</h3>
            <p>Usability Testing</p>
            <p>Visual Design</p>
            <p>Problem-Solving</p>
            <p>Communication</p>
            <p>Time Management</p>
            <p>Adobe PhotoShop & Illustrator</p>
            <p>Sketch</p>
            <p>HTML5 & CSS3</p>
            <div style="width: 100%;  border: 1px solid;"></div>
            <h3 class="header3 margin">EDUCATION</h3>
            <p>Bachelor of Science in Information Technology - 2023</p>
            <div style="width: 100%;  border: 1px solid;"></div>
            <h3 class="header3 margin">WORK HISTORY</h3>
            <p class="bold">Junior UX Designer , 02/2023 - Current GowraTech, LLC - Dallas , Texas</p>
            <p class="bold">Graphic Designer Intern , 02/2022 - 02/2023 Paladin - Dallas , Texas</p>
        </div>
    </div> 
        </div>
    </div>
</div>



    </main>



    <script>
        // Check if the 'userid' is present in localStorage
        const userid = localStorage.getItem('userid');
        console.log("userid from localStorage:", userid); // Log for debugging

        // If 'userid' is not found, redirect to the login page
        if (!userid) {
            window.location.href = '/';
        }
        function logout() {
    // Remove 'userid' from localStorage
    localStorage.removeItem('userid');
    // Redirect to login page or perform logout action
    window.location.href = '/';
    }        


    function showModal(userid) {
    const modal = document.getElementById('modal');
    const fullnameElement = document.getElementById('fullname');
    const objectiveElement = document.getElementById('objective');
    const professionalSkillsContainer = document.querySelector('.professional_skills');

    const useridField = document.getElementById('userid'); // Hidden field to store the user ID
    const modalTitle = document.getElementById('modal-title'); // Element to display the welcome message

    // Set the userid in the hidden input field
    useridField.value = userid; // Dynamically set the hidden input value

    // Log the userid to make sure it's correct
    console.log(`showModal called with userid: ${userid}`);

    // Fetch user data from the server
    fetch(`/get-user/${userid}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert('Error: ' + data.error);
            } else {
                // Set the content of the fullname (contenteditable)
                fullnameElement.textContent = data.fullname || 'None';  // This will display the fullname inside the contenteditable field

                // Set the content of the objective (contenteditable)
                objectiveElement.textContent = data.objective || 'None';  // This will display the objective inside the contenteditable field
                
                console.log(`Professional skills for userid ${userid}:`, data.professional_skills);
                professionalSkillsContainer.innerHTML = '';
                 // Populate professional skills
                 if (Array.isArray(data.professional_skills)) {
                    data.professional_skills.forEach((skill, index) => {
                        const skillParagraph = document.createElement('p');
                        skillParagraph.textContent = skill;
                        skillParagraph.setAttribute('data-index', index); // Optional, for tracking
                        professionalSkillsContainer.appendChild(skillParagraph);
                    });
                } else {
                    professionalSkillsContainer.textContent = 'No skills available.';
                }
                
                // Show the modal
                modal.style.display = 'block';

                // Update the modal title with a welcome message using the username
                if (modalTitle) {
                    modalTitle.textContent = `Welcome ${data.username || 'User'}!`;
                }

                // Log the data to make sure the correct user data is retrieved
                console.log(`Modal data for userid ${userid}:`, data);
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('Error fetching user data');
        });
}





function enableEdit() {
    const saveButton = document.getElementById('saveButton');
    
    // Enable the save button when edit starts
    saveButton.disabled = false;

    const fullnameElement = document.getElementById('fullname');
    const objectiveElement = document.getElementById('objective');
    
    // Make the fullname field editable
    fullnameElement.contentEditable = true; // Allow editing
    objectiveElement.contentEditable = true; // Allow editing
    // Optionally change the style (e.g., border color) to indicate it's in editable state
    fullnameElement.style.border = '1px solid #ccc';
    objectiveElement.style.border = '1px solid #ccc';
    fullnameElement.focus();  // Optionally focus the field for easier editing
    objectiveElement.focus();  // Optionally focus the field for easier editing
    // Optionally disable the edit button after edit begins
    const editButton = document.querySelector('.edit-button');
    if (editButton) {
        editButton.disabled = true;  // Disable the edit button to prevent multiple clicks
    } else {
        console.error("Edit button not found!");
    }
}





// Show output message function
function showOutputMessage(message, isError = false) {
    const outputMessageDiv = document.getElementById('output_message');
    outputMessageDiv.style.display = 'block';
    outputMessageDiv.innerText = message;
    
    // Add a background color based on success or error
    if (isError) {
        outputMessageDiv.style.backgroundColor = '#f8d7da';
        outputMessageDiv.style.color = '#721c24';
    } else {
        outputMessageDiv.style.backgroundColor = '#d4edda';
        outputMessageDiv.style.color = '#155724';
    }
}

// Save button click handler
function saveChanges() {
    // Get the user ID and fullname from the modal
    const userid = document.getElementById('userid').value;
    const fullnameElement = document.getElementById('fullname');
    const objectiveElement = document.getElementById('objective');
    const newFullname = fullnameElement.textContent || fullnameElement.innerText;  // Get the content from the editable field
    const newObjective = objectiveElement.textContent || objectiveElement.innerText;  // Get the content from the editable field
    // Ensure the user ID and fullname exist before proceeding
    if (!userid || !newFullname) {
        showOutputMessage('User ID or Full Name is missing!', true);
        return;
    }
    if (!newObjective) {
        showOutputMessage('Objective is missing.', true);
        return;
    }

    // Get the CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Prepare the data to send
    const data = {
        userid: userid,
        fullname: newFullname,
        objective: newObjective,
        _token: csrfToken // Include CSRF token for security
    };

    // Prepare the AJAX request
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/update-user', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Handle the response
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                showOutputMessage('Changes saved successfully!', false); // Success message
                fullnameElement.contentEditable = false; // Make the fullname non-editable after save
                objectiveElement.contentEditable = false; // Make the objective non-editable after save
                fullnameElement.style.border = ''; // Reset the border style
                objectiveElement.style.border = ''; // Reset the border style
                const saveButton = document.getElementById('saveButton');
                saveButton.disabled = true; // Disable the save button again
                const editButton = document.querySelector('.edit-button');
                if (editButton) {
                    editButton.disabled = false; // Enable the edit button again
                }
            } else {
                showOutputMessage('Failed to save changes.', true); // Error message
            }
        } else {
            showOutputMessage('Error: ' + xhr.statusText, true); // Error handling for request failure
        }
    };

    // Handle errors
    xhr.onerror = function() {
        showOutputMessage('Error submitting the form.', true); // Error if something goes wrong with AJAX
    };

    // Send the data as a JSON string
    xhr.send(JSON.stringify(data));
}



































function closeModal() {
    const modal = document.getElementById('modal');
    const outputMessage = document.getElementById('output_message'); // Assuming there's an element with this ID for output messages

    // Close the modal
    modal.style.display = 'none';
    
    // Clear the output message content
    if (outputMessage) {
        outputMessage.textContent = ''; // Clear the text content of the output message element
    }
}



// Close modal if clicked outside content
window.onclick = function (event) {
    const modal = document.getElementById('modal');
    if (event.target === modal) {
        closeModal();
    }
};
    </script>
</body>
</html>
