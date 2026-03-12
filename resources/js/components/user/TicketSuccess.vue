<template>
    <div class="success-container">
      <div class="background-effects">
        <div class="blob blob-cyan"></div>
        <div class="blob blob-blue"></div>
      </div>
  
      <div class="content-wrapper">
        <div class="card-wrapper">
          <div class="glow-border"></div>
          
          <div class="success-card">
            <div class="icon-section">
              <div class="icon-circle">
                <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                  <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
              </div>
            </div>
  
            <h1 class="title-gradient">
              {{ isIssue ? 'Issue Reported Successfully!' : 'Suggestion Submitted!' }}
            </h1>
            
            <p class="description">
              {{ isIssue 
                ? 'Your support ticket has been created and our team will review it shortly.' 
                : 'Thank you for sharing your ideas! We appreciate your feedback and will review it carefully.' 
              }}
            </p>
  
            <div v-if="isIssue" class="ticket-box">
              <div class="ticket-header">
                <svg class="file-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                  <polyline points="14 2 14 8 20 8"></polyline>
                  <line x1="16" y1="13" x2="8" y2="13"></line>
                  <line x1="16" y1="17" x2="8" y2="17"></line>
                  <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                <span class="ticket-label">Ticket ID</span>
              </div>
              <div class="ticket-id">
                {{ ticketId }}
              </div>
              <p class="ticket-help">
                Please save this ID for future reference
              </p>
            </div>
  
            <div class="info-box">
              <p class="info-text">
                {{ isIssue 
                  ? 'You will receive updates via the Dashboard. Typical response time is within 1-2 operational days.' 
                  : 'We review all suggestions regularly. Your input helps us create a better experience for everyone.' 
                }}
              </p>
            </div>
  
            <div class="button-group">
              <router-link to="/dashboard" class="btn btn-primary">
                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                  <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                Back to Dashboard
              </router-link>
              
              <router-link :to="isIssue ? '/report' : '/suggest'" class="btn btn-secondary">
                {{ isIssue ? 'Report Another Issue' : 'Send Another Suggestion' }}
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { computed } from 'vue';
  
  // Read the state passed from the router push. Default to 'issue' if none is found.
  const type = history.state?.type || 'issue';
  const isIssue = computed(() => type === 'issue');
  
  // Generate a random ticket ID once when the component mounts
  const ticketId = `TK-${Math.floor(Math.random() * 100000).toString().padStart(5, '0')}`;
  </script>
  
  <style scoped>
  /* --- Layout & Background --- */
  .success-container {
    min-height: 100vh;
    background: linear-gradient(to bottom right, #0a0e1a, #0d1426, #050a1a);
    display: flex;
    align-items: center;
    justify-content: center;
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
  
  /* --- Card & Glowing Border --- */
  .content-wrapper {
    position: relative;
    width: 100%;
    max-width: 42rem;
    z-index: 10;
  }
  
  .card-wrapper {
    position: relative;
  }
  
  .glow-border {
    position: absolute;
    top: -2px; right: -2px; bottom: -2px; left: -2px;
    background: linear-gradient(to right, #22c55e, #10b981, #22c55e);
    border-radius: 0.6rem;
    filter: blur(12px);
    opacity: 0.3;
    z-index: -1;
  }
  
  .success-card {
    position: relative;
    background: linear-gradient(to bottom right, #0f1729, #1a2235);
    border-radius: 0.5rem;
    padding: 3rem;
    text-align: center;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(6, 182, 212, 0.2);
  }
  
  /* --- Icon Section --- */
  .icon-section {
    display: flex;
    justify-content: center;
    margin-bottom: 1.5rem;
  }
  
  .icon-circle {
    width: 6rem;
    height: 6rem;
    background: linear-gradient(to bottom right, #4ade80, #10b981);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 15px -3px rgba(34, 197, 94, 0.5);
    animation: pulse-icon 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
  }
  
  .check-icon {
    width: 3rem;
    height: 3rem;
    color: white;
  }
  
  @keyframes pulse-icon {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.8; transform: scale(0.95); }
  }
  
  /* --- Typography --- */
  .title-gradient {
    font-size: 1.875rem;
    font-weight: 700;
    margin: 0 0 0.75rem 0;
    background: linear-gradient(to right, #67e8f9, #60a5fa);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
  }
  
  .description {
    color: rgba(165, 243, 252, 0.8);
    font-size: 1.125rem;
    margin: 0 0 2rem 0;
    line-height: 1.5;
  }
  
  /* --- Boxes (Ticket & Info) --- */
  .ticket-box {
    background-color: rgba(10, 14, 26, 0.5);
    border: 1px solid rgba(6, 182, 212, 0.3);
    border-radius: 0.5rem;
    padding: 1.5rem;
    margin-bottom: 2rem;
  }
  
  .ticket-header {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    margin-bottom: 0.5rem;
  }
  
  .file-icon { width: 1.25rem; height: 1.25rem; color: #22d3ee; }
  .ticket-label { color: rgba(165, 243, 252, 0.6); }
  
  .ticket-id {
    font-size: 1.5rem;
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-weight: 700;
    color: #67e8f9;
  }
  
  .ticket-help {
    color: rgba(165, 243, 252, 0.5);
    font-size: 0.875rem;
    margin: 0.75rem 0 0 0;
  }
  
  .info-box {
    background-color: rgba(6, 182, 212, 0.1);
    border: 1px solid rgba(6, 182, 212, 0.3);
    border-radius: 0.5rem;
    padding: 1rem;
    margin-bottom: 2rem;
  }
  
  .info-text {
    color: #cffafe;
    font-size: 0.875rem;
    margin: 0;
    line-height: 1.5;
  }
  
  /* --- Buttons --- */
  .button-group {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    justify-content: center;
  }
  
  @media (min-width: 640px) {
    .button-group { flex-direction: row; }
  }
  
  .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
  }
  
  .btn-icon { width: 1.25rem; height: 1.25rem; }
  
  .btn-primary {
    background: linear-gradient(to right, #06b6d4, #3b82f6);
    color: white;
    box-shadow: 0 10px 15px -3px rgba(6, 182, 212, 0.3);
  }
  
  .btn-primary:hover {
    background: linear-gradient(to right, #22d3ee, #60a5fa);
    box-shadow: 0 10px 15px -3px rgba(34, 211, 238, 0.4);
  }
  
  .btn-secondary {
    background-color: rgba(15, 23, 41, 0.5);
    border: 1px solid rgba(6, 182, 212, 0.3);
    color: #22d3ee;
  }
  
  .btn-secondary:hover {
    color: #67e8f9;
    border-color: rgba(34, 211, 238, 0.5);
  }
  </style>