<?php
// extra.php - HTML code for Left Side Panel
?>
<!-- Right Side Tools Panel -->

<!-- Add this under the analog watch in extra.php -->
<div id="greetingMessage" class="greeting-text">শুভ সকাল</div>

<!-- Analog Watch -->
<div id="analogWatch" title="এনালগ ঘড়ি">
    <canvas id="watchCanvas" width="80" height="80"></canvas>
    <div id="digitalTime"></div>
</div>

<!-- Left Side Tools Panel -->
<div class="left-tools-panel collapsed">
    <div class="tools-header">
        <span>🛠️ টুলস</span>
        <button class="toggle-tools" id="toggleTools">▼</button>
    </div>
    
    <div class="tools-content" id="toolsContent">
        <!-- 1. Weather widget -->
        <div class="tool-item weather-tool" id="weatherWidget">
            <div class="tool-header" onclick="toggleTool(this)">
                <span class="tool-icon">☁️</span>
                <span class="tool-title">আবহাওয়া</span>
                <span class="toggle-icon">▼</span>
            </div>
            <div class="tool-body">
                <div class="weather-main">
                    <div class="weather-icon" id="weatherIcon">☀️</div>
                    <div class="weather-temp" id="weatherTemp">--°C</div>
                </div>
                <div class="weather-details">
                    <div class="weather-city" id="weatherCity">ঢাকা</div>
                    <div class="weather-condition" id="weatherCondition">লোড হচ্ছে...</div>
                    <div class="weather-humidity" id="weatherHumidity">আর্দ্রতা: --%</div>
                    <div class="weather-wind" id="weatherWind">বাতাস: -- km/h</div>
                </div>
                <button class="refresh-btn" onclick="refreshWeather()">⟳ আপডেট</button>
            </div>
        </div>
        
        
        <!-- 2. Monthly Calendar -->
        <div class="tool-item monthly-calendar-tool" id="monthlyCalendarWidget">
            <div class="tool-header" onclick="toggleTool(this)">
                <span class="tool-icon">📆</span>
                <span class="tool-title">ক্যালেন্ডার ২০২৬</span>
                <span class="toggle-icon">▼</span>
            </div>
            <div class="tool-body">
                <!-- Month Change Button -->
                <div class="calendar-nav">
                    <button class="month-nav-btn" id="prevMonthBtn" onclick="changeMonth(-1)">◀</button>
                    <span class="current-month" id="displayMonthYear">ফেব্রুয়ারি ২০২৬</span>
                    <button class="month-nav-btn" id="nextMonthBtn" onclick="changeMonth(1)">▶</button>
                </div>
                
                <!-- Calendar Grid -->
                <div class="calendar-grid" id="monthlyCalendarGrid">
                </div>
            </div>
        </div>
        
        <!-- 3. Battery status -->
        <div class="tool-item battery-tool" id="batteryWidget">
            <div class="tool-header" onclick="toggleTool(this)">
                <span class="tool-icon">🔋</span>
                <span class="tool-title">ব্যাটারি</span>
                <span class="toggle-icon">▼</span>
            </div>
            <div class="tool-body">
                <div class="battery-main">
                    <div class="battery-icon" id="batteryIcon">🔋</div>
                    <div class="battery-level" id="batteryPercentage">--%</div>
                </div>
                <div class="battery-progress">
                    <div class="progress-bar" id="batteryProgress" style="width: 0%"></div>
                </div>
                <div class="battery-details">
                    <div class="battery-status" id="batteryStatus">চেক করছে...</div>
                    <div class="battery-time" id="batteryTime">--</div>
                </div>
                <div class="battery-warning" id="batteryWarning"></div>
            </div>
        </div>
        
        <!-- 4. Quick Note Pad -->
        <div class="tool-item note-tool" id="noteWidget">
            <div class="tool-header" onclick="toggleTool(this)">
                <span class="tool-icon">📝</span>
                <span class="tool-title">কুইক নোট</span>
                <span class="toggle-icon">▼</span>
            </div>
            <div class="tool-body">
                <textarea class="note-area" id="noteArea" placeholder="নোট লিখুন..."></textarea>
                <div class="note-actions">
                    <button class="note-btn" onclick="saveNote()">💾 সেভ</button>
                    <button class="note-btn" onclick="clearNote()">🗑️ ক্লিয়ার</button>
                    <button class="note-btn" onclick="copyNote()">📋 কপি</button>
                </div>
                <div class="note-status" id="noteStatus"></div>
            </div>
        </div>
        
        <!-- 5. Calculator -->
        <div class="tool-item calculator-tool" id="calculatorWidget">
            <div class="tool-header" onclick="toggleTool(this)">
                <span class="tool-icon">🧮</span>
                <span class="tool-title">ক্যালকুলেটর</span>
                <span class="toggle-icon">▼</span>
            </div>
            <div class="tool-body">
                <div class="calc-display">
                    <input type="text" id="calcDisplay" readonly value="0">
                </div>
                <div class="calc-buttons">
                    <button class="calc-btn calc-clear" onclick="clearCalc()">C</button>
                    <button class="calc-btn calc-clear" onclick="backspaceCalc()">⌫</button>
                    <button class="calc-btn calc-operator" onclick="appendCalc('%')">%</button>
                    <button class="calc-btn calc-operator" onclick="appendCalc('/')">÷</button>
                    
                    <button class="calc-btn" onclick="appendCalc('7')">7</button>
                    <button class="calc-btn" onclick="appendCalc('8')">8</button>
                    <button class="calc-btn" onclick="appendCalc('9')">9</button>
                    <button class="calc-btn calc-operator" onclick="appendCalc('*')">×</button>
                    
                    <button class="calc-btn" onclick="appendCalc('4')">4</button>
                    <button class="calc-btn" onclick="appendCalc('5')">5</button>
                    <button class="calc-btn" onclick="appendCalc('6')">6</button>
                    <button class="calc-btn calc-operator" onclick="appendCalc('-')">−</button>
                    
                    <button class="calc-btn" onclick="appendCalc('1')">1</button>
                    <button class="calc-btn" onclick="appendCalc('2')">2</button>
                    <button class="calc-btn" onclick="appendCalc('3')">3</button>
                    <button class="calc-btn calc-operator" onclick="appendCalc('+')">+</button>
                    
                    <button class="calc-btn calc-zero" onclick="appendCalc('0')">0</button>
                    <button class="calc-btn" onclick="appendCalc('.')">.</button>
                    <button class="calc-btn calc-equals" onclick="calculateCalc()">=</button>
                </div>
            </div>
        </div>
    </div>
</div>