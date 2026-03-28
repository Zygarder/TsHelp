<template>
    <div class="suggestion-container">
      <div class="background-effects">
        <div class="blob blob-cyan"></div>
        <div class="blob blob-blue"></div>
      </div>

      <div class="content-wrapper">
        <div class="header-section">
          <router-link to="/dashboard" class="back-link">
            <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="19" y1="12" x2="5" y2="12"></line>
              <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Dashboard
          </router-link>

          <div class="title-group">
            <div class="icon-wrapper yellow-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1.3.5 2.6 1.5 3.5.8.8 1.3 1.5 1.5 2.5"></path>
                <path d="M9 18h6"></path>
                <path d="M10 22h4"></path>
              </svg>
            </div>
            <div>
              <h1 class="text-gradient">Send a Suggestion</h1>
              <p class="subtitle">Share your ideas to help us improve</p>
            </div>
          </div>
        </div>

        <div class="form-card-wrapper">
          <div class="glow-border"></div>

          <div class="form-card">
            <form @submit.prevent="handleSubmit" class="suggestion-form">

              <div class="info-box">
                <div class="info-content">
                  <svg class="info-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1.3.5 2.6 1.5 3.5.8.8 1.3 1.5 1.5 2.5"></path>
                    <path d="M9 18h6"></path>
                    <path d="M10 22h4"></path>
                  </svg>
                  <div>
                    <h3 class="info-title">We value your feedback!</h3>
                    <p class="info-text">
                      Your suggestions help us improve our facilities, services, and overall experience. Share your ideas for improvements, new features, or any feedback you'd like us to consider.
                    </p>
                  </div>
                </div>
              </div>

              <div class="form-section">
                <label for="suggestion" class="section-label">
                  Your Suggestion <span class="required-star">*</span>
                </label>
                <p class="helper-text">
                  Please provide as much detail as possible. What would you like to see improved or added?
                </p>
                <textarea
                  id="suggestion"
                  v-model="suggestionText"
                  required
                  rows="12"
                  class="form-textarea"
                  placeholder="Share your ideas, suggestions, or feedback here..."
                ></textarea>
              </div>

              <div class="char-count">
                {{ suggestionText.length }} characters
              </div>

              <div class="submit-section">
                <button type="submit" class="submit-button">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                  </svg>
                  Submit Suggestion
                </button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios'; // Make sure to import axios!

const router = useRouter();
const suggestionText = ref('');
const isSubmitting = ref(false); // Good to stop double-clicks

const handleSubmit = async () => {
    // Don't submit if it's empty
    if (!suggestionText.value.trim()) return;

    isSubmitting.value = true;

    try {
        // 1. Send the data to your Laravel backend
        await axios.post('http://127.0.0.1:8000/api/client/suggestions', {
            content: suggestionText.value,
            submitted_by: 'Student'
        });


        router.push({
            path: '/success',
            state: { type: 'suggestion' }
        });

    } catch (error) {
        console.error('Failed to save suggestion:', error);
        alert('Failed to submit. Please try again.');
    } finally {
        isSubmitting.value = false;
    }
};
</script>

  <style scoped>
  /* --- Layout & Background --- */
  .suggestion-container {
    min-height: 100vh;
    background: linear-gradient(to bottom right, #0a0e1a, #0d1426, #050a1a);
    padding: 1.5rem;
    position: relative;
    overflow: hidden;
    font-family: ui-sans-serif, system-ui, -apple-system, sans-serif;
  }

  .background-effects {
    position: absolute;
    inset: 0;
    overflow: hidden;
    pointer-events: none;
  }

  .blob {
    position: absolute;
    width: 24rem;
    height: 24rem;
    border-radius: 50%;
    filter: blur(64px);
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
  }

  .blob-cyan { top: 25%; left: 25%; background-color: rgba(6, 182, 212, 0.1); }
  .blob-blue { bottom: 25%; right: 25%; background-color: rgba(59, 130, 246, 0.1); animation-delay: 1s; }

  @keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: .5; }
  }

  .content-wrapper {
    position: relative;
    max-width: 48rem; /* max-w-3xl */
    margin: 0 auto;
    z-index: 10;
  }

  /* --- Header --- */
  .header-section { margin-bottom: 2rem; }

  .back-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #22d3ee;
    text-decoration: none;
    font-size: 0.875rem;
    margin-bottom: 1.5rem;
    transition: color 0.2s;
  }
  .back-link:hover { color: #67e8f9; }
  .arrow-icon { width: 1rem; height: 1rem; }

  .title-group {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .icon-wrapper {
    width: 3rem;
    height: 3rem;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
  }

  /* Unique Yellow Icon Styling */
  .yellow-icon {
    background: linear-gradient(to bottom right, #eab308, #f59e0b);
    box-shadow: 0 10px 15px -3px rgba(234, 179, 8, 0.5);
  }

  .text-gradient {
    font-size: 1.875rem;
    font-weight: 700;
    margin: 0;
    background: linear-gradient(to right, #67e8f9, #60a5fa);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
  }

  .subtitle { color: rgba(165, 243, 252, 0.6); margin: 0.25rem 0 0 0; }

  /* --- Form Card --- */
  .form-card-wrapper { position: relative; }

  .glow-border {
    position: absolute;
    top: -2px; right: -2px; bottom: -2px; left: -2px;
    background: linear-gradient(to right, #06b6d4, #3b82f6, #06b6d4);
    border-radius: 0.6rem;
    filter: blur(8px);
    opacity: 0.2;
    z-index: -1;
  }

  .form-card {
    background: linear-gradient(to bottom right, #0f1729, #1a2235);
    border-radius: 0.5rem;
    padding: 2rem;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(6, 182, 212, 0.2);
  }

  .suggestion-form { display: flex; flex-direction: column; gap: 1.5rem; }

  /* --- Info Box --- */
  .info-box {
    background-color: rgba(234, 179, 8, 0.1);
    border: 1px solid rgba(234, 179, 8, 0.3);
    border-radius: 0.5rem;
    padding: 1rem;
  }

  .info-content {
    display: flex;
    gap: 0.75rem;
  }

  .info-icon {
    color: #facc15;
    flex-shrink: 0;
    margin-top: 0.125rem;
  }

  .info-title {
    color: #fef08a;
    font-weight: 600;
    font-size: 1rem;
    margin: 0 0 0.25rem 0;
  }

  .info-text {
    color: rgba(253, 230, 138, 0.7);
    font-size: 0.875rem;
    margin: 0;
    line-height: 1.5;
  }

  /* --- Input Area --- */
  .section-label {
    display: block;
    font-size: 1.125rem;
    color: #cffafe;
    margin-bottom: 0.5rem;
  }
  .required-star { color: #f87171; }

  .helper-text { font-size: 0.875rem; color: rgba(165, 243, 252, 0.6); margin: 0 0 0.75rem 0; }

  .form-textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    background-color: rgba(10, 14, 26, 0.5);
    border: 1px solid rgba(6, 182, 212, 0.3);
    border-radius: 0.5rem;
    color: #cffafe;
    font-size: 1rem;
    transition: all 0.2s;
    box-sizing: border-box;
    font-family: inherit;
    resize: vertical;
    min-height: 150px;
  }

  .form-textarea::placeholder { color: rgba(6, 182, 212, 0.3); }
  .form-textarea:focus { outline: none; border-color: #22d3ee; box-shadow: 0 0 0 2px rgba(34, 211, 238, 0.2); }

  .char-count {
    text-align: right;
    font-size: 0.875rem;
    color: rgba(165, 243, 252, 0.6);
    margin-top: -1rem; /* Pull it up closer to the textarea */
  }

  /* --- Submit Button --- */
  .submit-section { padding-top: 0.5rem; }

  .submit-button {
    width: 100%;
    padding: 1rem;
    /* Unique Yellow/Amber Gradient for this button */
    background: linear-gradient(to right, #eab308, #f59e0b);
    color: white;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    font-size: 1.125rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    transition: all 0.2s;
    box-shadow: 0 10px 15px -3px rgba(234, 179, 8, 0.3);
  }

  .submit-button:hover {
    background: linear-gradient(to right, #facc15, #fbbf24);
    box-shadow: 0 10px 15px -3px rgba(250, 204, 21, 0.4);
  }
  </style>
