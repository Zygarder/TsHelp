<template>
    <div class="dashboard-container">
      <div class="background-effects">
        <div class="blob blob-cyan"></div>
        <div class="blob blob-blue"></div>
      </div>
  
      <div class="content-wrapper">
        <header class="dashboard-header">
          <div class="header-brand">
            <div class="icon-wrapper brand-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                <line x1="8" y1="21" x2="16" y2="21"></line>
                <line x1="12" y1="17" x2="12" y2="21"></line>
              </svg>
            </div>
            <div>
              <h1 class="text-gradient">Tech Support Portal</h1>
              <p class="subtitle">How can we help you today?</p>
            </div>
          </div>
          
          <router-link to="/" class="sign-out-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
              <polyline points="16 17 21 12 16 7"></polyline>
              <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            Sign Out
          </router-link>
        </header>
  
        <div class="cards-grid">
          
          <router-link to="/report" class="action-card-link card-red">
            <div class="card-inner-wrapper">
              <div class="glow-effect red-glow"></div>
              
              <div class="action-card">
                <div class="icon-wrapper card-icon red-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                  </svg>
                </div>
                
                <h2 class="card-title">Report an Issue</h2>
                <p class="card-description">
                  Submit a ticket for hardware malfunctions, room appliances, or any technical problems you're experiencing.
                </p>
                
                <div class="card-action red-action">
                  <span class="action-text">Get Help Now</span>
                  <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </div>
          </router-link>
  
          <router-link to="/suggest" class="action-card-link card-yellow">
            <div class="card-inner-wrapper">
              <div class="glow-effect yellow-glow"></div>
              
              <div class="action-card">
                <div class="icon-wrapper card-icon yellow-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18h6"></path>
                    <path d="M10 22h4"></path>
                    <path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0 0 18 8 6 6 0 0 0 6 8c0 1 .23 2.23 1.5 3.5.76.76 1.23 1.52 1.41 2.5"></path>
                  </svg>
                </div>
                
                <h2 class="card-title">Send a Suggestion</h2>
                <p class="card-description">
                  Share your ideas and suggestions to help us improve our services and facilities.
                </p>
                
                <div class="card-action yellow-action">
                  <span class="action-text">Share Your Ideas</span>
                  <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </div>
          </router-link>
  
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  // No reactive state needed yet! We are just routing.
  </script>
  
  <style scoped>
  /* --- Layout & Background --- */
  .dashboard-container {
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
  
  .content-wrapper {
    position: relative;
    max-width: 72rem;
    margin: 0 auto;
    z-index: 10;
  }
  
  /* --- Header --- */
  .dashboard-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 3rem;
    flex-wrap: wrap;
    gap: 1rem;
  }
  
  .header-brand {
    display: flex;
    align-items: center;
    gap: 1rem;
  }
  
  .brand-icon {
    width: 3rem;
    height: 3rem;
    background: linear-gradient(to bottom right, #22d3ee, #3b82f6);
    box-shadow: 0 10px 15px -3px rgba(6, 182, 212, 0.5);
    border-radius: 0.5rem;
    color: white;
  }
  
  .icon-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
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
    margin: 0.25rem 0 0 0;
  }
  
  .sign-out-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background-color: rgba(15, 23, 41, 0.5);
    border: 1px solid rgba(6, 182, 212, 0.3);
    border-radius: 0.5rem;
    color: #22d3ee;
    text-decoration: none;
    transition: all 0.2s;
  }
  
  .sign-out-btn:hover {
    color: #67e8f9;
    border-color: rgba(34, 211, 238, 0.5);
  }
  
  /* --- Grid System --- */
  .cards-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    max-width: 56rem;
    margin: 0 auto;
  }
  
  @media (min-width: 768px) {
    .cards-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  
  /* --- Action Cards --- */
  .action-card-link {
    text-decoration: none;
    display: block;
    height: 100%;
  }
  
  .card-inner-wrapper {
    position: relative;
    height: 100%;
  }
  
  .glow-effect {
    position: absolute;
    top: -2px; right: -2px; bottom: -2px; left: -2px;
    border-radius: 0.6rem;
    filter: blur(8px);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
  }
  
  .red-glow { background: linear-gradient(to right, #ef4444, #f97316, #ef4444); }
  .yellow-glow { background: linear-gradient(to right, #eab308, #f59e0b, #eab308); }
  
  .action-card {
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
    background: linear-gradient(to bottom right, #0f1729, #1a2235);
    border-radius: 0.5rem;
    padding: 2rem;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(6, 182, 212, 0.2);
    transition: all 0.3s ease;
    box-sizing: border-box;
  }
  
  .card-icon {
    width: 5rem;
    height: 5rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
    color: white;
    transition: box-shadow 0.3s ease;
  }
  
  .red-icon { background: linear-gradient(to bottom right, #ef4444, #f97316); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
  .yellow-icon { background: linear-gradient(to bottom right, #eab308, #f59e0b); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
  
  .card-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #cffafe;
    margin: 0 0 0.75rem 0;
  }
  
  .card-description {
    color: rgba(165, 243, 252, 0.6);
    margin: 0 0 1.5rem 0;
    flex-grow: 1;
    line-height: 1.5;
  }
  
  .card-action {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: color 0.3s ease;
  }
  
  .action-text { font-weight: 600; }
  
  .arrow-icon {
    width: 1.25rem;
    height: 1.25rem;
    transition: transform 0.3s ease;
  }
  
  .red-action { color: #f87171; }
  .yellow-action { color: #facc15; }
  
  /* --- Hover States --- */
  .card-red:hover .glow-effect,
  .card-yellow:hover .glow-effect {
    opacity: 0.3;
  }
  
  .card-red:hover .action-card { border-color: rgba(239, 68, 68, 0.4); }
  .card-yellow:hover .action-card { border-color: rgba(234, 179, 8, 0.4); }
  
  .card-red:hover .red-icon { box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.5); }
  .card-yellow:hover .yellow-icon { box-shadow: 0 10px 15px -3px rgba(234, 179, 8, 0.5); }
  
  .card-red:hover .red-action { color: #fca5a5; }
  .card-yellow:hover .yellow-action { color: #fde047; }
  
  .action-card-link:hover .arrow-icon {
    transform: translateX(4px);
  }
  </style>