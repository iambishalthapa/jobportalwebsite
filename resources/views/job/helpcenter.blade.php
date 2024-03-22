<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Portal Help Center</title>
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
      margin: 30px auto !important;
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
@include('job.jobnavigationbar') 


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
      { question: 'How do I create an account?', answer: 'You can create an account by clicking on the "Sign Up" button and filling out the registration form.' },
      { question: 'How do I apply for a job?', answer: 'To apply for a job, navigate to the job listing and click on the "Apply Now" button. Follow the instructions to complete the application process.' },
      { question: 'What should I include in my resume?', answer: 'Make sure to include your contact information, a professional summary, work experience, education, skills, and any relevant certifications.' },
      { question: 'How can I edit my profile?', answer: 'Log in to your account, go to the profile section, and click on the "Edit Profile" button. Make the necessary changes and save your updated information.' },
      { question: 'How do I reset my password?', answer: 'If you forgot your password, click on the "Forgot Password" link on the login page. Follow the instructions to reset your password via email.' },
      { question: 'Can I upload multiple resumes?', answer: 'Yes, you can upload multiple resumes with different focuses. Go to your profile settings to manage and switch between them.' },
      { question: 'How do I receive job notifications?', answer: 'Ensure your notification settings are enabled in your profile. You will receive job notifications based on your preferences and saved searches.' },
      { question: 'Is my personal information safe?', answer: 'Yes, we prioritize the security of your personal information. Our platform uses encryption and follows industry best practices to protect your data.' },
      { question: 'How do I delete my account?', answer: 'To delete your account, contact our support team through the "Contact Us" page, and they will assist you with the account deletion process.' },
      { question: 'What types of jobs are available?', answer: 'Our job portal offers a wide range of job opportunities across various industries, including technology, healthcare, finance, and more. Explore the job listings to find the right fit for you.' }
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
