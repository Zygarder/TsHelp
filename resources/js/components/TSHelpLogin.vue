<template>
  <div class="login-container">
    <div class="background-effects">
      <div class="blob blob-cyan"></div>
      <div class="blob blob-blue"></div>
    </div>

    <div class="card-wrapper">
      <div class="glow-border"></div>
      
      <div class="login-card">
        <div class="header-section">
          <div class="icon-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="monitor-icon">
              <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
              <line x1="8" y1="21" x2="16" y2="21"></line>
              <line x1="12" y1="17" x2="12" y2="21"></line>
            </svg>
          </div>
          <h1 class="text-gradient">Tech Support System</h1>
          <p class="subtitle">Sign in to continue</p>
        </div>

        <form @submit.prevent="handleLogin" class="form-section">
          <div class="input-group">
            <label for="email" class="input-label">Email Address</label>
            <input
              id="email"
              v-model="email"
              type="email"
              class="form-input"
              :class="{ 'input-error': emailError }"
              placeholder="Enter your email"
              @input="clearEmailError"
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
              placeholder="Enter your password"
              @input="clearPasswordError"
            />
            <p v-if="passwordError" class="error-text">{{ passwordError }}</p>
          </div>

          <div class="flex-between">
            <label class="checkbox-container">
              <input type="checkbox" v-model="rememberMe" class="custom-checkbox" />
              <span class="checkbox-text">Remember me</span>
            </label>
            <router-link to="/forgot-password" class="forgot-link">Forgot password?</router-link>
          </div>

          <button type="submit" class="submit-button" :disabled="isLoading">
            {{ buttonText }}
          </button>
        </form>

        <div class="footer-section">
          <p class="footer-text">
            Don't have an account? 
            <router-link to="/register" class="register-link">Register here</router-link>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router'; // Add this at the top

const router = useRouter(); // Initialize it inside <script setup>
// Reactive state
const email = ref('');
const password = ref('');
const rememberMe = ref(false);
const emailError = ref('');
const passwordError = ref('');
const isLoading = ref(false);

const isValidEmailFormat = (e) => {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(e);
};

const clearEmailError = () => { emailError.value = ''; };
const clearPasswordError = () => { passwordError.value = ''; };

const handleLogin = () => {
  emailError.value = '';
  passwordError.value = '';

  if (!email.value) emailError.value = 'Please enter your email.';
  if (!password.value) passwordError.value = 'Please enter your password.';
  
  if (email.value && !isValidEmailFormat(email.value)) {
    emailError.value = 'Please use a valid email format.';
  }

  if (emailError.value || passwordError.value) return;

  isLoading.value = true;
  
  // Simulate API call
  setTimeout(() => {
    isLoading.value = false;
    router.push('/dashboard');
    //console.log('Logged in:', { email: email.value, password: password.value, remember: rememberMe.value });
    // In reality, Vue Router would navigate here: router.push('/dashboard')
  }, 2000);
};

const buttonText = computed(() => isLoading.value ? 'Authenticating...' : 'Sign In');
</script>

<style scoped>
/* --- Background & Layout --- */
.login-container {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1.5rem;
  /* Translated: bg-gradient-to-br from-[#0a0e1a] via-[#0d1426] to-[#050a1a] */
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
  width: 24rem; /* 96 * 0.25rem */
  height: 24rem;
  border-radius: 50%;
  filter: blur(64px); /* blur-3xl */
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.blob-cyan {
  top: 25%;
  left: 25%;
  background-color: rgba(6, 182, 212, 0.1); /* bg-cyan-500/10 */
}

.blob-blue {
  bottom: 25%;
  right: 25%;
  background-color: rgba(59, 130, 246, 0.1); /* bg-blue-500/10 */
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
  max-width: 28rem; /* max-w-md */
  z-index: 10;
}

/* Translated: absolute -inset-0.5 bg-gradient-to-r from-cyan-500 via-blue-500 to-cyan-500 rounded-lg blur opacity-30 */
.glow-border {
  position: absolute;
  top: -2px; right: -2px; bottom: -2px; left: -2px;
  background: linear-gradient(to right, #06b6d4, #3b82f6, #06b6d4);
  border-radius: 0.6rem;
  filter: blur(8px);
  opacity: 0.3;
  z-index: -1;
}

.login-card {
  position: relative;
  /* Translated: bg-gradient-to-br from-[#0f1729] to-[#1a2235] */
  background: linear-gradient(to bottom right, #0f1729, #1a2235);
  border-radius: 0.5rem;
  padding: 2rem;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
  border: 1px solid rgba(6, 182, 212, 0.2); /* border-cyan-500/20 */
}

/* --- Header & Typography --- */
.header-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 2rem;
}

/* Translated: bg-gradient-to-br from-cyan-400 to-blue-500 */
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

/* Translated: bg-gradient-to-r from-cyan-300 to-blue-400 bg-clip-text text-transparent */
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
  color: rgba(165, 243, 252, 0.6); /* text-cyan-200/60 */
  margin-top: 0.5rem;
  font-size: 1rem;
}

/* --- Form Fields --- */
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
  color: #cffafe; /* text-cyan-100 */
  margin-bottom: 0.5rem;
  font-size: 0.875rem;
}

/* Translated: bg-[#0a0e1a]/50 border border-cyan-500/30 rounded-lg text-cyan-100 */
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
  border-color: #22d3ee; /* focus:border-cyan-400 */
  box-shadow: 0 0 0 2px rgba(34, 211, 238, 0.2); /* focus:ring-2 focus:ring-cyan-400/20 */
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
.flex-between {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.checkbox-container {
  display: flex;
  align-items: center;
  cursor: pointer;
}

.custom-checkbox {
  width: 1rem;
  height: 1rem;
  background-color: rgba(10, 14, 26, 0.5);
  border: 1px solid rgba(6, 182, 212, 0.3);
  border-radius: 0.25rem;
  accent-color: #22d3ee;
}

.checkbox-text {
  margin-left: 0.5rem;
  font-size: 0.875rem;
  color: rgba(165, 243, 252, 0.6);
}

.forgot-link, .register-link {
  font-size: 0.875rem;
  color: #22d3ee; /* text-cyan-400 */
  text-decoration: none;
  transition: color 0.2s;
}

.forgot-link:hover, .register-link:hover {
  color: #67e8f9; /* hover:text-cyan-300 */
}

.register-link {
  font-weight: 600;
}

/* --- Submit Button --- */
/* Translated: bg-gradient-to-r from-cyan-500 to-blue-500 ... */
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