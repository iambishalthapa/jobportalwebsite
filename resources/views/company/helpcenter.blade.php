<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Company Help Center - Job Portal</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
  <style>
       body {
      font-family: 'Roboto', sans-serif;
      padding: 60px;
      margin: 0;
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    header {
      background-color: #4285f4;
      color: #ffffff;
      padding: 10px;
      text-align: center;
    }
    .container {
      width: 80%;
      margin: 30px 195px !important;
      max-width: 800px;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      box-sizing: border-box;
    }
    h1, h2, h3 {
      color: #4285f4;
    }
    #searchInput{
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      box-sizing: border-box;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    .qa-card {
      cursor: pointer;
      margin: 10px 0;
      padding: 15px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      transition: box-shadow 0.3s;
    }
    .qa-card:hover {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
<!-- Include your company navigation bar here -->
@include('company.navigationbar')
  <div class="container">

    <!-- Search Functionality -->
    <h2>Search Questions</h2>
    <input type="text" id="searchInput" oninput="searchQuestions()" placeholder="Search for questions...">

    <!-- Display Questions and Answers -->
    <div id="qaContainer">
      <!-- Questions and answers will be displayed here -->
    </div>
  </div>

  <script>
    // Demo data for demonstration purposes
    const faqData = [
      { question: 'How do I post a job vacancy?', answer: 'To post a job vacancy, log in to your company account, navigate to the "Post a Job" section, and follow the instructions to create and publish your job listing.' },
      { question: 'Can I edit an already posted job?', answer: 'Yes, you can edit a posted job. Go to your company dashboard, find the job listing, and click on the "Edit" button. Make the necessary changes and save the updated information.' },
      { question: 'How do I review job applications?', answer: 'To review job applications, log in to your company account, go to the "Applications" section, and view the list of candidates who have applied for your job. You can review their resumes and cover letters.' },
      { question: 'What should I include in a compelling job description?', answer: 'A compelling job description should include details about the job responsibilities, required qualifications, company culture, and any unique benefits. Make it engaging to attract suitable candidates.' },
      { question: 'How can I manage my company profile?', answer: 'Log in to your company account, navigate to the company profile section, and click on the "Edit Profile" button. Make the necessary changes to your company information and save the updated profile.' },
      { question: 'How do I deactivate a job listing?', answer: 'To deactivate a job listing, go to your company dashboard, find the job you want to deactivate, and click on the "Deactivate" button. The job will no longer be visible to job seekers.' },
      { question: 'Is it possible to receive email notifications for new job applications?', answer: 'Yes, you can enable email notifications for new job applications. Adjust your notification settings in the company account to receive timely updates on candidate applications.' },
      { question: 'What measures are in place to protect company data?', answer: 'We prioritize the security of your company data. Our platform uses advanced encryption and follows industry best practices to ensure the confidentiality and integrity of your information.' },
      { question: 'How do I delete my company account?', answer: 'To delete your company account, contact our support team through the "Contact Us" page, and they will guide you through the account deletion process.' },
      { question: 'Can I customize the appearance of my job listings?', answer: 'Yes, you can customize the appearance of your job listings. Add your company logo, choose a unique color scheme, and provide a detailed and visually appealing job description to make your listings stand out.' },
      // Additional demo questions
      { question: 'How do I reset my company password?', answer: 'If you forgot your company password, click on the "Forgot Password" link on the login page. Follow the instructions to reset your password via email.' },
      { question: 'What types of jobs get more visibility?', answer: 'Jobs with detailed and engaging descriptions, along with clear requirements, tend to get more visibility. Make sure to highlight the unique aspects of your job listings.' },
    ];

    // Function to submit a question
    function submitQuestion() {
      const questionText = document.getElementById('question').value;
      if (questionText.trim() !== '') {
        // Add the new question to the data (for demonstration purposes)
        faqData.push({ question: questionText, answer: 'Your question will be answered shortly.' });

        // Update the displayed questions and answers
        displayQuestionsAndAnswers();
        // Clear the question input field
        document.getElementById('question').value = '';
      }
    }

    // Function to search questions
    function searchQuestions() {
      const searchInput = document.getElementById('searchInput').value.toLowerCase();
      const filteredData = faqData.filter(entry => entry.question.toLowerCase().includes(searchInput));
      displayQuestionsAndAnswers(filteredData);
    }

    // Function to display questions and answers
    function displayQuestionsAndAnswers(data = faqData) {
      const qaContainer = document.getElementById('qaContainer');
      qaContainer.innerHTML = '';

      data.forEach((entry, index) => {
        const qaCard = document.createElement('div');
        qaCard.classList.add('qa-card');
        qaCard.innerHTML = `
          <h3 onclick="showAnswer(${index})">${entry.question}</h3>
          <p>${entry.answer}</p>
        `;
        qaContainer.appendChild(qaCard);
      });
    }

    // Function to show detailed answer when clicking on a question
    function showAnswer(index) {
      const detailedAnswer = faqData[index].answer;
      alert(detailedAnswer); // You can customize this to display the answer in a modal or a dedicated section on the page.
    }

    // Initial display of questions and answers
    displayQuestionsAndAnswers();
  </script>
</body>
</html>
