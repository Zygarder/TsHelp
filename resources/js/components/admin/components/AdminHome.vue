<template>
    <div class="admin-home">
      <section class="stats-section">
        <h3>Overview Statistics</h3>
        <div class="stats-grid">
          <div class="stat-card purple">
            <div class="stat-icon"><FileTextIcon :size="20" /></div>
            <span class="stat-label">To Review</span>
            <span class="stat-number">3</span>
          </div>
          <div class="stat-card yellow">
            <div class="stat-icon"><ClockIcon :size="20" /></div>
            <span class="stat-label">Pending</span>
            <span class="stat-number">2</span>
          </div>
          <div class="stat-card green">
            <div class="stat-icon"><CheckCircleIcon :size="20" /></div>
            <span class="stat-label">Completed</span>
            <span class="stat-number">1</span>
          </div>
          <div class="stat-card red">
            <div class="stat-icon"><XCircleIcon :size="20" /></div>
            <span class="stat-label">Rejected</span>
            <span class="stat-number">1</span>
          </div>
          <div class="stat-card orange">
            <div class="stat-icon"><LightbulbIcon :size="20" /></div>
            <span class="stat-label">Suggestions</span>
            <span class="stat-number">5</span>
          </div>
        </div>
      </section>
  
      <section class="task-section">
        <h3>Currently Working On</h3>
        <div class="task-card">
          <div class="task-header">
            <div class="task-avatar">
              <ZapIcon :size="20" />
            </div>
            <div class="task-title">
              <h4>Active Task</h4>
              <span>Priority ticket in progress</span>
            </div>
          </div>
  
          <div class="task-body">
            <div class="task-tags">
              <span class="tag-id">TK-00123</span>
              <span class="tag-priority">HIGH</span>
              <span class="tag-status">In Progress</span>
            </div>
            <h5>Hardware Malfunction - Computer Lab Unit</h5>
            <div class="task-meta">
              <span><MapPinIcon :size="14" /> Computer Lab A - PC-07</span>
              <span><CalendarIcon :size="14" /> 3/12/2026</span>
            </div>
            <p>Computer won't turn on. No lights, no response. Tried different power outlet but still not working.</p>
          </div>
  
          <div class="task-actions">
            <button class="btn-secondary">View Details</button>
            <button class="btn-primary"><CheckIcon :size="16" /> Mark Complete</button>
          </div>
        </div>
      </section>
    </div>
  </template>
  
  <script setup>
  import { 
    FileText as FileTextIcon, Clock as ClockIcon, CheckCircle as CheckCircleIcon, 
    XCircle as XCircleIcon, Lightbulb as LightbulbIcon, Zap as ZapIcon,
    MapPin as MapPinIcon, Calendar as CalendarIcon, Check as CheckIcon
  } from 'lucide-vue-next';
  </script>
  
  <style scoped>
  h3 { color: #67e8f9; margin-bottom: 1.5rem; font-size: 1.25rem; }
  
  /* STATS GRID */
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
    margin-bottom: 3rem;
  }
  
  .stat-card {
    background: rgba(15, 23, 41, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 1.5rem;
    border-radius: 12px;
    position: relative;
    overflow: hidden;
  }
  
  .stat-icon { margin-bottom: 1rem; }
  .stat-label { font-size: 0.875rem; color: rgba(165, 243, 252, 0.6); display: block; }
  .stat-number { font-size: 2rem; font-weight: bold; margin-top: 0.5rem; display: block; }
  
  /* Colors for specific cards */
  .purple .stat-icon { color: #a855f7; } .purple .stat-number { color: #a855f7; }
  .yellow .stat-icon { color: #eab308; } .yellow .stat-number { color: #eab308; }
  .green .stat-icon { color: #22c55e; } .green .stat-number { color: #22c55e; }
  .red .stat-icon { color: #ef4444; } .red .stat-number { color: #ef4444; }
  .orange .stat-icon { color: #f59e0b; } .orange .stat-number { color: #f59e0b; }
  
  /* TASK CARD */
  .task-card {
    background: linear-gradient(to bottom right, rgba(15, 23, 41, 0.8), rgba(30, 41, 59, 0.8));
    border: 1px solid rgba(34, 211, 238, 0.2);
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
  }
  
  .task-header { display: flex; gap: 1rem; align-items: center; margin-bottom: 1.5rem; }
  .task-avatar { 
    width: 48px; height: 48px; background: #0ea5e9; 
    border-radius: 10px; display: flex; align-items: center; justify-content: center; 
  }
  .task-title h4 { margin: 0; font-size: 1.1rem; color: #fff; }
  .task-title span { font-size: 0.8rem; color: rgba(165, 243, 252, 0.5); }
  
  .task-tags { display: flex; gap: 0.5rem; margin-bottom: 1rem; }
  .tag-id { color: #22d3ee; font-family: monospace; font-weight: bold; }
  .tag-priority { background: rgba(245, 158, 11, 0.1); color: #f59e0b; padding: 2px 8px; border-radius: 4px; font-size: 0.7rem; border: 1px solid rgba(245, 158, 11, 0.3); }
  .tag-status { background: rgba(234, 179, 8, 0.1); color: #eab308; padding: 2px 8px; border-radius: 4px; font-size: 0.7rem; }
  
  .task-body h5 { font-size: 1.25rem; margin: 0.5rem 0; color: #f1f5f9; }
  .task-meta { display: flex; gap: 1.5rem; color: rgba(165, 243, 252, 0.4); font-size: 0.85rem; margin-bottom: 1rem; }
  .task-meta span { display: flex; align-items: center; gap: 5px; }
  
  .task-actions { display: flex; gap: 1rem; border-top: 1px solid rgba(255, 255, 255, 0.05); pt: 1.5rem; margin-top: 1.5rem; padding-top: 1.5rem; }
  .btn-primary { background: #059669; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 8px; font-weight: bold; }
  .btn-secondary { background: rgba(34, 211, 238, 0.1); color: #22d3ee; border: 1px solid rgba(34, 211, 238, 0.2); padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; }
  </style>