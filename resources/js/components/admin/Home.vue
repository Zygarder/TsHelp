<template>
    <div class="admin-home">
      <div class="section">
        <h2 class="section-title">Overview Statistics</h2>
        <div class="stats-grid">
          
          <div class="stat-card border-purple">
            <div class="stat-header">
              <div class="icon-box bg-purple-light">
                <svg class="icon text-purple" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                  <polyline points="14 2 14 8 20 8"></polyline>
                  <line x1="16" y1="13" x2="8" y2="13"></line>
                  <line x1="16" y1="17" x2="8" y2="17"></line>
                  <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
              </div>
              <p class="stat-label">To Review</p>
            </div>
            <p class="stat-value text-purple-bright">{{ toReviewCount }}</p>
          </div>
  
          <div class="stat-card border-yellow">
            <div class="stat-header">
              <div class="icon-box bg-yellow-light">
                <svg class="icon text-yellow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
              </div>
              <p class="stat-label">Pending</p>
            </div>
            <p class="stat-value text-yellow-bright">{{ pendingCount }}</p>
          </div>
  
          <div class="stat-card border-green">
            <div class="stat-header">
              <div class="icon-box bg-green-light">
                <svg class="icon text-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                  <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
              </div>
              <p class="stat-label">Completed</p>
            </div>
            <p class="stat-value text-green-bright">{{ completedCount }}</p>
          </div>
  
          <div class="stat-card border-red">
            <div class="stat-header">
              <div class="icon-box bg-red-light">
                <svg class="icon text-red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="15" y1="9" x2="9" y2="15"></line>
                  <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
              </div>
              <p class="stat-label">Rejected</p>
            </div>
            <p class="stat-value text-red-bright">{{ rejectedCount }}</p>
          </div>
  
          <div class="stat-card border-amber">
            <div class="stat-header">
              <div class="icon-box bg-amber-light">
                <svg class="icon text-amber" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1.3.5 2.6 1.5 3.5.8.8 1.3 1.5 1.5 2.5"></path>
                  <path d="M9 18h6"></path>
                  <path d="M10 22h4"></path>
                </svg>
              </div>
              <p class="stat-label">Suggestions</p>
            </div>
            <p class="stat-value text-amber-bright">{{ suggestionsCount }}</p>
          </div>
  
        </div>
      </div>
  
      <div v-if="activeReport" class="section">
        <h2 class="section-title">Currently Working On</h2>
        <div class="active-task-wrapper">
          <div class="glow-border"></div>
          <div class="active-task-card">
            
            <div class="active-task-header">
              <div class="active-icon-box">
                <svg class="icon text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                </svg>
              </div>
              <div>
                <h3 class="task-title">Active Task</h3>
                <p class="task-subtitle">Priority ticket in progress</p>
              </div>
            </div>
  
            <div class="task-details-box">
              <div class="task-meta">
                <div class="meta-left">
                  <span class="ticket-id">{{ activeReport.ticketId }}</span>
                  <span v-if="activeReport.priority" class="badge badge-priority" :class="getPriorityClass(activeReport.priority)">
                    <svg v-if="activeReport.priority === 'critical'" class="badge-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                    <svg v-else-if="activeReport.priority === 'high'" class="badge-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                    {{ activeReport.priority.toUpperCase() }}
                  </span>
                  <span class="badge badge-progress">In Progress</span>
                </div>
              </div>
  
              <h4 class="issue-type">{{ activeReport.issueType }}</h4>
              
              <div class="location-date">
                <span class="info-item">
                  <svg class="icon-small" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                  {{ activeReport.location }} - {{ activeReport.specificItem }}
                </span>
                <span class="info-item">
                  <svg class="icon-small" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                  {{ formatDate(activeReport.submittedAt) }}
                </span>
              </div>
              
              <p class="description">{{ activeReport.description }}</p>
  
              <div class="action-buttons">
                <button @click="selectedReport = activeReport" class="btn btn-outline">
                  View Details
                </button>
                <button @click="$emit('completeActive')" class="btn btn-success">
                  <svg class="icon-small" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                  Mark Complete
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="section">
        <h2 class="section-title">Recent Activity</h2>
        <div class="activity-grid">
          
          <div class="activity-card">
            <div class="activity-header">
              <svg class="icon text-cyan" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
              <h3 class="activity-title">Total Reports</h3>
            </div>
            <p class="activity-value text-cyan-bright">{{ reports.length }}</p>
            <p class="activity-subtitle">All time tickets submitted</p>
          </div>
  
          <div class="activity-card">
            <div class="activity-header">
              <svg class="icon text-orange" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
              <h3 class="activity-title">Needs Attention</h3>
            </div>
            <p class="activity-value text-orange-bright">{{ toReviewCount }}</p>
            <p class="activity-subtitle">Reports waiting for review</p>
          </div>
  
        </div>
      </div>
  
      <ReportDetailModal 
        v-if="selectedReport" 
        :report="selectedReport" 
        @close="selectedReport = null" 
        @update="handleUpdateReport"
      />
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue';
  import ReportDetailModal from './ReportDetailModal.vue'; // We'll make this component next!
  
  const props = defineProps({
    reports: {
      type: Array,
      required: true,
      default: () => []
    },
    activeReport: {
      type: Object,
      default: null
    }
  });
  
  const emit = defineEmits(['updateReport', 'completeActive']);
  
  const selectedReport = ref(null);
  
  // Computed stats
  const toReviewCount = computed(() => props.reports.filter(r => r.status === 'to-review').length);
  const pendingCount = computed(() => props.reports.filter(r => r.status === 'pending').length);
  const rejectedCount = computed(() => props.reports.filter(r => r.status === 'rejected').length);
  const completedCount = computed(() => props.reports.filter(r => r.status === 'completed').length);
  const suggestionsCount = ref(5); // Mock count
  
  // Helpers
  const getPriorityClass = (priority) => {
    switch (priority) {
      case 'critical': return 'priority-critical';
      case 'high': return 'priority-high';
      case 'medium': return 'priority-medium';
      case 'low': return 'priority-low';
      default: return 'priority-default';
    }
  };
  
  const formatDate = (dateString) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleDateString();
  };
  
  const handleUpdateReport = (report) => {
    emit('updateReport', report);
  };
  </script>
  
  <style scoped>
  /* --- Layout --- */
  .admin-home {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    font-family: ui-sans-serif, system-ui, -apple-system, sans-serif;
  }
  
  .section { display: flex; flex-direction: column; }
  .section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #cffafe;
    margin: 0 0 1rem 0;
  }
  
  /* --- Stats Grid --- */
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 1rem;
  }
  @media (min-width: 640px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
  @media (min-width: 1024px) { .stats-grid { grid-template-columns: repeat(5, 1fr); } }
  
  .stat-card {
    background: linear-gradient(to bottom right, rgba(15, 23, 41, 0.8), rgba(26, 34, 53, 0.8));
    border-radius: 0.5rem;
    padding: 1.25rem;
    border: 1px solid;
  }
  
  .border-purple { border-color: rgba(168, 85, 247, 0.3); }
  .border-yellow { border-color: rgba(234, 179, 8, 0.3); }
  .border-green { border-color: rgba(34, 197, 94, 0.3); }
  .border-red { border-color: rgba(239, 68, 68, 0.3); }
  .border-amber { border-color: rgba(245, 158, 11, 0.3); }
  
  .stat-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.5rem;
  }
  
  .icon-box {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .bg-purple-light { background-color: rgba(168, 85, 247, 0.2); }
  .bg-yellow-light { background-color: rgba(234, 179, 8, 0.2); }
  .bg-green-light { background-color: rgba(34, 197, 94, 0.2); }
  .bg-red-light { background-color: rgba(239, 68, 68, 0.2); }
  .bg-amber-light { background-color: rgba(245, 158, 11, 0.2); }
  
  .icon { width: 1.25rem; height: 1.25rem; }
  .text-purple { color: #c084fc; }
  .text-yellow { color: #facc15; }
  .text-green { color: #4ade80; }
  .text-red { color: #f87171; }
  .text-amber { color: #fbbf24; }
  .text-cyan { color: #22d3ee; }
  .text-orange { color: #fb923c; }
  .text-white { color: white; }
  
  .stat-label {
    color: rgba(216, 180, 254, 0.6);
    font-size: 0.875rem;
    margin: 0;
  }
  .stat-card.border-yellow .stat-label { color: rgba(253, 230, 138, 0.6); }
  .stat-card.border-green .stat-label { color: rgba(187, 247, 208, 0.6); }
  .stat-card.border-red .stat-label { color: rgba(254, 202, 202, 0.6); }
  .stat-card.border-amber .stat-label { color: rgba(253, 230, 138, 0.6); }
  
  .stat-value {
    font-size: 1.875rem;
    font-weight: 700;
    margin: 0;
  }
  .text-purple-bright { color: #d8b4fe; }
  .text-yellow-bright { color: #fdf08a; }
  .text-green-bright { color: #86efac; }
  .text-red-bright { color: #fca5a5; }
  .text-amber-bright { color: #fcd34d; }
  
  /* --- Active Task Section --- */
  .active-task-wrapper { position: relative; }
  
  .glow-border {
    position: absolute;
    top: -2px; right: -2px; bottom: -2px; left: -2px;
    background: linear-gradient(to right, #06b6d4, #3b82f6, #a855f7);
    border-radius: 0.6rem;
    filter: blur(8px);
    opacity: 0.3;
    z-index: 0;
  }
  
  .active-task-card {
    position: relative;
    background: linear-gradient(to bottom right, #0f1729, #1a2235);
    border-radius: 0.5rem;
    padding: 1.5rem;
    border: 1px solid rgba(6, 182, 212, 0.3);
    z-index: 1;
  }
  
  .active-task-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }
  
  .active-icon-box {
    width: 2.5rem;
    height: 2.5rem;
    background: linear-gradient(to bottom right, #22d3ee, #3b82f6);
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .task-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #cffafe;
    margin: 0;
  }
  
  .task-subtitle {
    font-size: 0.875rem;
    color: rgba(165, 243, 252, 0.6);
    margin: 0;
  }
  
  .task-details-box {
    background-color: rgba(10, 14, 26, 0.5);
    border-radius: 0.5rem;
    padding: 1rem;
    border: 1px solid rgba(6, 182, 212, 0.2);
  }
  
  .task-meta {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.75rem;
  }
  
  .meta-left {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }
  
  .ticket-id {
    color: #22d3ee;
    font-family: monospace;
    font-weight: 600;
  }
  
  .badge {
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    border: 1px solid;
  }
  .badge-icon { width: 0.75rem; height: 0.75rem; }
  
  .priority-critical { color: #f87171; background-color: rgba(239, 68, 68, 0.2); border-color: rgba(239, 68, 68, 0.3); }
  .priority-high { color: #fb923c; background-color: rgba(249, 115, 22, 0.2); border-color: rgba(249, 115, 22, 0.3); }
  .priority-medium { color: #facc15; background-color: rgba(234, 179, 8, 0.2); border-color: rgba(234, 179, 8, 0.3); }
  .priority-low { color: #60a5fa; background-color: rgba(59, 130, 246, 0.2); border-color: rgba(59, 130, 246, 0.3); }
  .priority-default { color: #9ca3af; background-color: rgba(107, 114, 128, 0.2); border-color: rgba(107, 114, 128, 0.3); }
  
  .badge-progress {
    background-color: rgba(234, 179, 8, 0.2);
    color: #fdf08a;
    border-color: rgba(234, 179, 8, 0.3);
    border-radius: 9999px; /* full rounded */
  }
  
  .issue-type {
    color: #cffafe;
    font-weight: 600;
    margin: 0 0 0.5rem 0;
  }
  
  .location-date {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 0.875rem;
    color: rgba(165, 243, 252, 0.6);
    margin-bottom: 0.75rem;
  }
  
  .info-item {
    display: flex;
    align-items: center;
    gap: 0.25rem;
  }
  .icon-small { width: 1rem; height: 1rem; }
  
  .description {
    color: rgba(207, 250, 254, 0.8);
    font-size: 0.875rem;
    margin: 0 0 1rem 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;  
    overflow: hidden;
  }
  
  /* Buttons */
  .action-buttons {
    display: flex;
    gap: 0.5rem;
  }
  
  .btn {
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s;
  }
  
  .btn-outline {
    background-color: rgba(6, 182, 212, 0.2);
    color: #67e8f9;
    border: 1px solid rgba(6, 182, 212, 0.3);
  }
  .btn-outline:hover { background-color: rgba(6, 182, 212, 0.3); }
  
  .btn-success {
    background-color: rgba(34, 197, 94, 0.2);
    color: #86efac;
    border: 1px solid rgba(34, 197, 94, 0.3);
  }
  .btn-success:hover { background-color: rgba(34, 197, 94, 0.3); }
  
  /* --- Activity Grid --- */
  .activity-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 1rem;
  }
  @media (min-width: 640px) { .activity-grid { grid-template-columns: repeat(2, 1fr); } }
  
  .activity-card {
    background: linear-gradient(to bottom right, rgba(15, 23, 41, 0.8), rgba(26, 34, 53, 0.8));
    border-radius: 0.5rem;
    padding: 1.25rem;
    border: 1px solid rgba(6, 182, 212, 0.2);
  }
  
  .activity-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
  }
  
  .activity-title {
    color: #cffafe;
    font-weight: 600;
    font-size: 1rem;
    margin: 0;
  }
  
  .activity-value {
    font-size: 1.875rem;
    font-weight: 700;
    margin: 0;
  }
  .text-cyan-bright { color: #67e8f9; }
  .text-orange-bright { color: #fb923c; }
  
  .activity-subtitle {
    color: rgba(165, 243, 252, 0.6);
    font-size: 0.875rem;
    margin: 0.5rem 0 0 0;
  }
  </style>