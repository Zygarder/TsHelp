<template>
    <div class="auth-container">
      <div class="background-effects">
        <div class="blob blob-cyan"></div>
        <div class="blob blob-blue"></div>
      </div>
  
      <div class="card-wrapper">
        <div class="glow-border"></div>
        
        <div class="auth-card">
          <div class="header-section">
            <div class="icon-container">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="monitor-icon">
                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                <line x1="8" y1="21" x2="16" y2="21"></line>
                <line x1="12" y1="17" x2="12" y2="21"></line>
              </svg>
            </div>
            <h1 class="text-gradient">Reset Password</h1>
            <p class="subtitle">Enter your email to receive reset instructions</p>
          </div>
  
          <form v-if="!submitted" @submit.prevent="handleSubmit" class="form-section">
            <div class="input-group">
              <label for="email" class="input-label">Email Address</label>
              <input
                id="email"
                v-model="email"
                type="email"
                class="form-input"
                :class="{ 'input-error': emailError }"
                placeholder="Enter your email"
                @input="clearError"
              />
              <p v-if="emailError" class="error-text">{{ emailError }}</p>
            </div>
  
            <button type="submit" class="submit-button" :disabled="isLoading">
              {{ buttonText }}
            </button>
          </form>
  
          <div v-else class="success-section">
            <div class="success-icon-wrapper">
              <svg class="success-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
            </div>
            <h3 class="success-title">Check your email</h3>
            <p class="success-text">
              We've sent password reset instructions to <strong>{{ email }}</strong>
            </p>
          </div>
  
          <div class="footer-section">
            <router-link to="/" class="back-link">
              <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
              </svg>
              Back to sign in
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue';
  
  const email = ref('');
  const submitted = ref(false);
  const isLoading = ref(false);
  const emailError = ref('');
  
  const isValidEmailFormat = (e) => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(e);
  };
  
  const clearError = () => {
    emailError.value = '';
  };
  
  const handleSubmit = () => {
    emailError.value = '';
  
    if (!email.value) {
      emailError.value = 'Please enter your email.';
      return;
    }
  
    if (!isValidEmailFormat(email.value)) {
      emailError.value = 'Please use a valid email format.';
      return;
    }
  
    isLoading.value = true;
    
    // Simulate API call to send email
    setTimeout(() => {
      isLoading.value = false;
      submitted.value = true;
    }, 1500);
  };
  
  const buttonText = computed(() => isLoading.value ? 'Sending...' : 'Send Reset Link');
  </script>
  
  <style scoped>
  /* --- Background & Layout (Reused) --- */
  .auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
    background: linear-gradient(to bottom right, #0a0e1a, #0d1426, #050a1a);
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
  
  .blob-cyan {
    top: 25%; left: 25%;
    background-color: rgba(6, 182, 212, 0.1);
  }
  
  .blob-blue {
    bottom: 25%; right: 25%;
    background-color: rgba(59, 130, 246, 0.1);
    animation-delay: 1s;
  }
  
  @keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: .5; }
  }
  
  /* --- Card Container (Reused) --- */
  .card-wrapper {
    position: relative;
    width: 100%;
    max-width: 28rem;
    z-index: 10;
  }
  
  .glow-border {
    position: absolute;
    top: -2px; right: -2px; bottom: -2px; left: -2px;
    background: linear-gradient(to right, #06b6d4, #3b82f6, #06b6d4);
    border-radius: 0.6rem;
    filter: blur(8px);
    opacity: 0.3;
    z-index: -1;
  }
  
  .auth-card {
    position: relative;
    background: linear-gradient(to bottom right, #0f1729, #1a2235);
    border-radius: 0.5rem;
    padding: 2rem;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(6, 182, 212, 0.2);
  }
  
  /* --- Header & Typography (Reused) --- */
  .header-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 2rem;
    text-align: center;
  }
  
  .icon-container {
    width: 4rem;
    height: 4rem;
    background: linear-gradient(to bottom right, #22d3ee, #3b82f6);
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    box-shadow: 0 10px 15px -3px rgba(6, 182, 212, 0.5);
  }
  
  .monitor-icon {
    color: white;
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
  
  .subtitle {
    color: rgba(165, 243, 252, 0.6);
    margin-top: 0.5rem;
    font-size: 1rem;
  }
  
  /* --- Form Fields (Reused) --- */
  .form-section {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }
  
  .input-group {
    display: flex;
    flex-direction: column;
  }
  
  .input-label {
    display: block;
    color: #cffafe;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
  }
  
  .form-input {
    width: 100%;
    padding: 0.75rem 1rem;
    background-color: rgba(10, 14, 26, 0.5);
    border: 1px solid rgba(6, 182, 212, 0.3);
    border-radius: 0.5rem;
    color: #cffafe;
    font-size: 1rem;
    transition: all 0.2s ease-in-out;
    box-sizing: border-box;
  }
  
  .form-input::placeholder { color: rgba(6, 182, 212, 0.3); }
  .form-input:focus {
    outline: none; border-color: #22d3ee;
    box-shadow: 0 0 0 2px rgba(34, 211, 238, 0.2);
  }
  .form-input.input-error {
    border-color: #ef4444;
    box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2);
  }
  .error-text { color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; }
  
  /* --- Submit Button (Reused) --- */
  .submit-button {
    width: 100%;
    padding: 0.75rem;
    background: linear-gradient(to right, #06b6d4, #3b82f6);
    color: white;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 4px 6px -1px rgba(6, 182, 212, 0.3);
  }
  
  .submit-button:hover:not(:disabled) {
    background: linear-gradient(to right, #22d3ee, #60a5fa);
    box-shadow: 0 10px 15px -3px rgba(34, 211, 238, 0.4);
  }
  
  .submit-button:disabled { opacity: 0.7; cursor: not-allowed; }
  
  /* --- Success Section (New) --- */
  .success-section {
    text-align: center;
    padding: 1.5rem 0;
  }
  
  .success-icon-wrapper {
    width: 4rem;
    height: 4rem;
    background-color: rgba(6, 182, 212, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem auto;
  }
  
  .success-icon {
    width: 2rem;
    height: 2rem;
    color: #22d3ee;
  }
  
  .success-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #cffafe;
    margin: 0 0 0.5rem 0;
  }
  
  .success-text {
    color: rgba(165, 243, 252, 0.6);
    margin: 0;
    line-height: 1.5;
  }
  .success-text strong {
    color: #cffafe;
  }
  
  /* --- Footer & Back Link --- */
  .footer-section {
    margin-top: 1.5rem;
    text-align: center;
  }
  
  .back-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #22d3ee;
    text-decoration: none;
    transition: color 0.2s;
    font-weight: 500;
  }
  
  .back-link:hover {
    color: #67e8f9;
  }
  
  .arrow-icon {
    width: 1rem;
    height: 1rem;
  }
  </style>