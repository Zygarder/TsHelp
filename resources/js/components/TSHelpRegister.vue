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
            <h1 class="text-gradient">Create Account</h1>
            <p class="subtitle">Join our support system</p>
          </div>
  
          <form @submit.prevent="handleRegister" class="form-section">
            <div class="input-group">
              <label for="name" class="input-label">Full Name</label>
              <input
                id="name"
                v-model="name"
                type="text"
                class="form-input"
                :class="{ 'input-error': nameError }"
                placeholder="Enter your full name"
                @input="clearErrors('name')"
              />
              <p v-if="nameError" class="error-text">{{ nameError }}</p>
            </div>
  
            <div class="input-group">
              <label for="email" class="input-label">Email Address</label>
              <input
                id="email"
                v-model="email"
                type="email"
                class="form-input"
                :class="{ 'input-error': emailError }"
                placeholder="Enter your email"
                @input="clearErrors('email')"
              />
              <p v-if="emailError" class="error-text">{{ emailError }}</p>
            </div>
  
            <div class="input-group">
              <label for="password" class="input-label">Password</label>
              <input
                id="password"
                v-model="password"
                type="password"
                class="form-input"
                :class="{ 'input-error': passwordError }"
                placeholder="Create a password"
                @input="clearErrors('password')"
              />
              <p v-if="passwordError" class="error-text">{{ passwordError }}</p>
            </div>
  
            <div class="input-group">
              <label for="confirmPassword" class="input-label">Confirm Password</label>
              <input
                id="confirmPassword"
                v-model="confirmPassword"
                type="password"
                class="form-input"
                :class="{ 'input-error': confirmError }"
                placeholder="Confirm your password"
                @input="clearErrors('confirm')"
              />
              <p v-if="confirmError" class="error-text">{{ confirmError }}</p>
            </div>
  
            <button type="submit" class="submit-button" :disabled="isLoading">
              {{ buttonText }}
            </button>
          </form>
  
          <div class="footer-section">
            <p class="footer-text">
              Already have an account? 
              <router-link to="/" class="login-link">Sign in</router-link>
            </p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue';
  import { useRouter } from 'vue-router'; 
  import axios from 'axios'; 
  
  const router = useRouter(); 
  
  const name = ref('');
  const email = ref('');
  const password = ref('');
  const confirmPassword = ref('');
  
  const nameError = ref('');
  const emailError = ref('');
  const passwordError = ref('');
  const confirmError = ref('');
  const isLoading = ref(false);
  
  const isValidEmailFormat = (e) => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(e);
  };
  
  const clearErrors = (field) => {
    if (field === 'name') nameError.value = '';
    if (field === 'email') emailError.value = '';
    if (field === 'password') {
      passwordError.value = '';
      confirmError.value = ''; 
    }
    if (field === 'confirm') confirmError.value = '';
  };
  
  const handleRegister = async () => { 
    nameError.value = '';
    emailError.value = '';
    passwordError.value = '';
    confirmError.value = '';
  
    if (!name.value) nameError.value = 'Please enter your full name.';
    if (!email.value) emailError.value = 'Please enter your email.';
    if (!password.value) passwordError.value = 'Please create a password.';
    if (!confirmPassword.value) confirmError.value = 'Please confirm your password.';
  
    if (email.value && !isValidEmailFormat(email.value)) {
      emailError.value = 'Please use a valid email format.';
    }
  
    if (password.value && confirmPassword.value && password.value !== confirmPassword.value) {
      confirmError.value = 'Passwords do not match.';
    }
  
    if (nameError.value || emailError.value || passwordError.value || confirmError.value) {
      return;
    }
  
    isLoading.value = true;
    
    try {
      const response = await axios.post('http://127.0.0.1:8000/api/register', {
        name: name.value,
        email: email.value,
        password: password.value
      });
  
      console.log('Account created:', response.data);
      router.push('/'); 
      
    } catch (error) {
      // Cleaned up the formatting here!
      if (error.response?.data?.errors?.email) {
        emailError.value = 'This email is already registered. Please sign in.';
      } else if (error.response?.data?.errors?.password) {
        passwordError.value = 'Make sure your password has 8 characters minimum.';
      } else {
        console.error('Registration failed:', error);
        alert('Something went wrong. Please try again.');
      }
    } finally {
      isLoading.value = false;
    }
  };
  
  const buttonText = computed(() => isLoading.value ? 'Creating Account...' : 'Create Account');
  </script>
  
  <style scoped>
  /* --- Background & Layout --- */
  .auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
    background: linear-gradient(to bottom right, #0a0e1a, #0d1426, #050a1a);
    position: relative;
    overflow: hidden;
    font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  }
  
  /* --- Animated Background Blobs --- */
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
    top: 25%;
    left: 25%;
    background-color: rgba(6, 182, 212, 0.1);
  }
  
  .blob-blue {
    bottom: 25%;
    right: 25%;
    background-color: rgba(59, 130, 246, 0.1);
    animation-delay: 1s;
  }
  
  @keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: .5; }
  }
  
  /* --- Card Container --- */
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
  
  /* --- Header & Typography --- */
  .header-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 2rem;
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
  
  /* --- Form Fields --- */
  .form-section {
    display: flex;
    flex-direction: column;
    gap: 1.25rem; /* Slightly tighter gap to fit 4 inputs nicely */
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
  
  .form-input::placeholder {
    color: rgba(6, 182, 212, 0.3);
  }
  
  .form-input:focus {
    outline: none;
    border-color: #22d3ee;
    box-shadow: 0 0 0 2px rgba(34, 211, 238, 0.2);
  }
  
  .form-input.input-error {
    border-color: #ef4444;
    box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2);
  }
  
  .error-text {
    color: #ef4444;
    font-size: 0.8rem;
    margin-top: 0.25rem;
  }
  
  /* --- Layout Utils & Links --- */
  .login-link {
    font-size: 0.875rem;
    color: #22d3ee;
    text-decoration: none;
    transition: color 0.2s;
    font-weight: 600;
  }
  
  .login-link:hover {
    color: #67e8f9;
  }
  
  /* --- Submit Button --- */
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
    box-shadow: 0 4px 6px -1px rgba(6, 182, 212, 0.3), 0 2px 4px -1px rgba(6, 182, 212, 0.3);
    margin-top: 0.5rem;
  }
  
  .submit-button:hover:not(:disabled) {
    background: linear-gradient(to right, #22d3ee, #60a5fa);
    box-shadow: 0 10px 15px -3px rgba(34, 211, 238, 0.4), 0 4px 6px -2px rgba(34, 211, 238, 0.4);
  }
  
  .submit-button:disabled {
    opacity: 0.7;
    cursor: not-allowed;
  }
  
  /* --- Footer --- */
  .footer-section {
    margin-top: 1.5rem;
    text-align: center;
  }
  
  .footer-text {
    color: rgba(165, 243, 252, 0.6);
    font-size: 0.875rem;
  }
  </style>