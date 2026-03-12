<template>
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-6">
      <div class="relative w-full max-w-2xl">
        <div class="absolute -inset-0.5 bg-linear-to-r from-yellow-500 via-amber-500 to-yellow-500 rounded-lg blur opacity-30"></div>
        
        <div class="relative bg-linear-to-br from-[#0f1729] to-[#1a2235] rounded-lg shadow-2xl border border-cyan-500/20">
          <div class="flex items-center justify-between p-6 border-b border-cyan-500/20">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-linear-to-br from-yellow-400 to-amber-500 rounded-lg flex items-center justify-center">
                <MessageSquareIcon class="w-5 h-5 text-white" />
              </div>
              <div>
                <h2 class="text-2xl font-bold bg-linear-to-r from-cyan-300 to-blue-400 bg-clip-text text-transparent">
                  Suggestion Details
                </h2>
                <span :class="[
                  'inline-block px-2 py-0.5 rounded-full text-xs font-semibold mt-1',
                  suggestion.isRead
                    ? 'bg-green-500/20 text-green-300 border border-green-500/30'
                    : 'bg-yellow-500/20 text-yellow-300 border border-yellow-500/30'
                ]">
                  {{ suggestion.isRead ? 'Read' : 'New' }}
                </span>
              </div>
            </div>
            <button
              @click="$emit('close')"
              class="w-10 h-10 bg-cyan-500/10 hover:bg-cyan-500/20 rounded-lg flex items-center justify-center transition-all text-cyan-400 hover:text-cyan-300"
            >
              <XIcon class="w-5 h-5" />
            </button>
          </div>
  
          <div class="p-6 space-y-6">
            <div class="grid grid-cols-3 gap-4">
              <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
                <div class="flex items-center gap-2 text-cyan-200/60 mb-2">
                  <UserIcon class="w-4 h-4" />
                  <span class="text-sm">Submitted By</span>
                </div>
                <p class="text-cyan-100 font-semibold">{{ suggestion.submittedBy }}</p>
              </div>
  
              <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
                <div class="flex items-center gap-2 text-cyan-200/60 mb-2">
                  <CalendarIcon class="w-4 h-4" />
                  <span class="text-sm">Date</span>
                </div>
                <p class="text-cyan-100 font-semibold">
                  {{ new Date(suggestion.submittedAt).toLocaleDateString() }}
                </p>
              </div>
  
              <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
                <div class="flex items-center gap-2 text-cyan-200/60 mb-2">
                  <ClockIcon class="w-4 h-4" />
                  <span class="text-sm">Time</span>
                </div>
                <p class="text-cyan-100 font-semibold">
                  {{ new Date(suggestion.submittedAt).toLocaleTimeString() }}
                </p>
              </div>
            </div>
  
            <div class="bg-[#0a0e1a]/50 rounded-lg p-6 border border-cyan-500/20">
              <div class="flex items-center gap-2 text-cyan-200/60 mb-4">
                <MessageSquareIcon class="w-4 h-4" />
                <span class="text-sm">Suggestion</span>
              </div>
              <p class="text-cyan-100 leading-relaxed text-lg">{{ suggestion.content }}</p>
            </div>
  
            <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-lg p-4">
              <p class="text-yellow-100 text-sm">
                <strong>Note:</strong> This suggestion has been marked as read. Review the feedback and consider implementing improvements based on user input.
              </p>
            </div>
          </div>
  
          <div class="flex gap-3 p-6 border-t border-cyan-500/20">
            <button
              @click="$emit('close')"
              class="flex-1 py-3 bg-linear-to-r from-cyan-500 to-blue-500 text-white rounded-lg hover:from-cyan-400 hover:to-blue-400 transition-all shadow-lg shadow-cyan-500/30 font-semibold"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { 
    X as XIcon, 
    Calendar as CalendarIcon, 
    Clock as ClockIcon, 
    User as UserIcon, 
    MessageSquare as MessageSquareIcon 
  } from 'lucide-vue-next';
  
  // 1. Define the props coming from the parent (SuggestionsList.vue)
  defineProps({
    suggestion: {
      type: Object,
      required: true
    }
  });
  
  // 2. Define the events this component can shout up to the parent
  defineEmits(['close']);
  </script>