-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2021 at 02:21 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news-portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(35) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'admin@admin.com', '$2y$10$b3GAX6.Pd6054RRQ8C9se.zfOhTljRkduBfAKWFrmtdKwj02aSTuq');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `article_title` varchar(200) NOT NULL,
  `article_description` text NOT NULL,
  `article_image` varchar(250) NOT NULL,
  `article_date` date NOT NULL,
  `article_trend` tinyint(1) NOT NULL,
  `article_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `category_id`, `author_id`, `article_title`, `article_description`, `article_image`, `article_date`, `article_trend`, `article_active`) VALUES
(1, 1, 1, 'India bans 59 Chinese apps, including TikTok, ShareIt, UC Browser', 'The Ministry of Electronics and Information Technology (MeitY) on Monday banned 59 Chinese apps, including Bytedance\'s TikTok, Alibaba\'s UC Browser, Tencent\'s WeChat, and Baidu Map, saying these pose a threat to the \"sovereignty and integrity of India\". The move to ban these apps was taken after the recent face-off at Galwan valley between India and China, and the action was taken under Section 69A of the Information Technology Act.', 'article-1-1616580787.webp', '2021-03-24', 0, 1),
(4, 1, 3, 'US election 2020: Trump and Biden locked in tight White House race', 'Donald Trump and his Democratic rival Joe Biden have been locked in a tight race for the White House, with the Republican narrowly ahead in a few key states that could decide the winner.The latest vote tally shows the Republican president a few points ahead in North Carolina, Georgia, Pennsylvania, Michigan and Wisconsin, of the handful of swing states that will determine the result.', 'article-1-1616582207.webp', '2021-03-24', 0, 1),
(6, 2, 1, 'OnePlus 8T Cyberpunk 2077 Limited Edition launched in India', 'OnePlus has launched the limited edition OnePlus 8T Cyberpunk 2077 Edition in India at a price of Rs 42,999. The smartphone comes with 12GB of RAM and 256GB of internal storage. The phone was launched in China last week with a retail box bundled with several accessories themed after an upcoming Cyberpunk 2077 video game.', 'article-2-1616580598.jpg', '2021-03-24', 0, 1),
(7, 2, 1, 'OnePlus 8T launched in India: Price, specs and everything else you need to know', 'OnePlus today unveiled its latest flagship smartphone, the OnePlus 8T, in India at a starting price of Rs 42,999 for the 8GB RAM and 128GB storage variant. The OnePlus 8T comes with a 6.55-inch display, 120Hz refresh rate, a quad-camera setup at the back and Warp Charge 65 fast charging technology.', 'article-2-1620564684.webp', '2021-03-24', 1, 1),
(17, 8, 3, 'Aftab chopped Shraddha into 35 pieces, hid them in new fridge for almost 3 weeks: Police', 'Aftab Amin Poonawala allegedly strangled his live-in partner Shraddha Walkar to death and sawed her body into 35 pieces which he kept in a 300-litre fridge for almost three weeks at his Mehrauli residence in South Delhi before dumping them across the city over several days, the police said.', 'article-8-1616578937.webp', '2021-04-03', 0, 1),
(19, 8, 2, 'Delhi air quality deteriorates to \'very poor\' category after slight respite', 'After a slight improvement in Delhi\'s air quality, it slipped to the \'very poor\' category on Tuesday, according to Central Pollution Control Board (CPCB) data. The city\'s air quality index (AQI) stood at 314 at 8 am. On Monday, it stood at 249. An AQI between zero and 50 is considered \'good\', 51 and 100 \'satisfactory\', 101 and 200 \'moderate\', 201 and 300 \'poor\', 301 and 400 \'very poor\', and 401 and 500 \'severe\'.', 'article-8-1616578990.jpg', '2021-04-01', 1, 1),
(20, 8, 3, 'After Bengaluru barber tests COVID-19 positive, 111 primary contacts quarantined', 'A day after a barber in Bengaluru\'s Malleshwaram area tested positive for the novel coronavirus, the city civic body quarantined 111 people in connection with the case, including 60 primary and 51 secondary contacts. The Bruhat Bengaluru Mahanagara Palike (BBMP) collected swab samples of all the primary contacts and results are awaited.', 'article-8-1620575059.jpg', '2021-03-31', 0, 1),
(28, 3, 3, 'How to make Hyderabadi Dum Ka Murgh', 'Hyderabadi Dum Ka Murgh is a traditional dish from the royal kitchens of Hyderabad. This aromatic chicken curry is slow-cooked with a blend of spices, yogurt, and saffron, resulting in tender meat with a rich, flavorful gravy. The \'dum\' cooking technique involves sealing the pot with dough to trap the steam, allowing the flavors to meld beautifully. Perfect for special occasions and family gatherings.', 'article-3-1616581072.jpg', '2021-03-25', 1, 1),
(29, 3, 2, 'Mumbai street food: A journey through flavors', 'Mumbai\'s street food culture is legendary, offering an explosion of tastes from vada pav to pani puri. Each dish tells a story of the city\'s diverse culinary heritage, blending influences from various communities. From the spicy bhel puri at Chowpatty Beach to the buttery pav bhaji in lanes of Colaba, Mumbai\'s street food is an experience that awakens all senses. Food vendors have perfected these recipes over generations.', 'article-3-1616581173.jpg', '2021-03-26', 0, 1),
(37, 4, 2, 'How online classes are bringing challenges to the education system', 'Since schools opened with help of technology and online classes, a major challenge that has come up is that most of the schools are not geared towards this way of learning because the infrastructure of online mode is not quite as available as offline mode. The second biggest challenge has been in the hands of the government to equally distribute the resources to everyone to close the gap of online learning.', 'article-4-1616582091.webp', '2021-04-26', 1, 1),
(38, 3, 3, 'Why it is important to have white onions in summer', 'A powerhouse of antioxidants, white onions are rich in Vitamin C and also have anti-bacterial, anti-fungal and anti-inflammatory properties. The presence of sulfur compounds help detoxify the body. They help reduce blood sugar levels, improve bone density, and have anti-cancer properties. The phytonutrients present in onions enhance immunity. The fiber content keeps the digestive system healthy.', 'article-3-1616581275.webp', '2021-04-26', 0, 1),
(39, 1, 5, 'Parliament passes landmark bill for electoral reforms', 'The Lok Sabha today passed a significant electoral reform bill aimed at increasing transparency in political funding and candidate selection. The legislation introduces stricter disclosure norms for political parties regarding their sources of income and expenditure. Opposition parties raised concerns about certain provisions, leading to heated debates that lasted several hours. The bill will now be sent to the Rajya Sabha for further deliberation and approval.', 'article-1-1616580787.webp', '2021-04-15', 1, 1),
(40, 1, 6, 'State elections witness record voter turnout', 'Multiple state assembly elections concluded today with an unprecedented voter turnout of 72%, marking the highest participation in the last two decades. Election officials attributed this success to extensive awareness campaigns and improved polling infrastructure. Political analysts suggest that key issues like unemployment, agricultural reforms, and healthcare dominated voter sentiment. Final results are expected within 48 hours.', 'article-1-1616582207.webp', '2021-05-02', 0, 1),
(41, 2, 7, 'India launches ambitious 5G rollout plan', 'The government today unveiled its comprehensive strategy for 5G network deployment across major cities by the end of this year. Telecom operators have committed significant investments totaling over Rs 50,000 crores for infrastructure development. The high-speed network promises to revolutionize sectors including healthcare, education, and manufacturing through enhanced connectivity. Rural areas will be covered in the subsequent phases over the next three years.', 'article-2-1616580598.jpg', '2021-04-20', 1, 1),
(42, 2, 8, 'Major tech company announces AI-powered smartphone', 'A leading smartphone manufacturer has revealed its latest flagship device featuring advanced artificial intelligence capabilities. The phone uses machine learning to optimize battery performance, enhance photography, and provide personalized user experiences. Industry experts believe this marks a significant leap in mobile technology. The device will be available in markets worldwide starting next month at a competitive price point.', 'article-2-1620564684.webp', '2021-05-05', 1, 1),
(43, 2, 1, 'Cybersecurity threats increase by 40% in financial sector', 'A recent report highlights a dramatic surge in cyberattacks targeting banks and financial institutions, with phishing and ransomware being the most common methods. Security experts emphasize the urgent need for robust defense mechanisms and employee training programs. Several major banks have already invested millions in upgrading their cybersecurity infrastructure. Regulatory authorities are considering stricter compliance requirements to protect customer data.', 'article-2-1616580598.jpg', '2021-04-28', 0, 1),
(44, 2, 9, 'Space agency successfully tests reusable rocket technology', 'The national space agency achieved a major milestone by successfully testing a reusable rocket system that could significantly reduce launch costs. The innovative technology allows the rocket\'s first stage to return and land vertically after deployment. This breakthrough positions the country among elite spacefaring nations with reusable launch capabilities. Scientists believe this will accelerate commercial space missions and satellite deployment programs.', 'article-2-1620564684.webp', '2021-05-08', 1, 1),
(45, 2, 10, 'Electric vehicle sales surge 150% in metropolitan cities', 'Sales of electric vehicles have witnessed exponential growth in major urban centers, driven by environmental awareness and government incentives. Automobile manufacturers are expanding their EV portfolios to meet increasing demand. Charging infrastructure is rapidly being developed across cities to support this transition. Industry analysts predict EVs will constitute 30% of total vehicle sales within the next five years.', 'article-2-1616580598.jpg', '2021-05-12', 0, 1),
(46, 3, 2, 'Regional cuisine festival celebrates culinary diversity', 'A month-long food festival showcasing regional cuisines from across the country opened today in the capital. Over 200 chefs are participating to present authentic traditional dishes representing different states and cultures. Food enthusiasts can experience everything from Kashmiri wazwan to Chettinad delicacies. The festival also includes cooking workshops and masterclasses by renowned culinary experts.', 'article-3-1616581072.jpg', '2021-04-18', 1, 1),
(47, 3, 11, 'Ancient recipes get modern makeover in new cookbook', 'A celebrated chef has published a comprehensive cookbook reimagining traditional recipes with contemporary techniques and presentation styles. The book features over 150 dishes spanning breakfast, main courses, and desserts. Each recipe includes historical context and nutritional information. Food critics have praised the work for successfully bridging the gap between heritage and innovation in Indian cooking.', 'article-3-1616581173.jpg', '2021-05-01', 0, 1),
(48, 4, 3, 'National education policy implementation gains momentum', 'Schools and universities across the country have begun implementing key provisions of the new education policy. The reforms emphasize multidisciplinary learning, flexibility in course selection, and integration of vocational training. Educational institutions are restructuring curricula and training teachers for the new framework. Parents and educators have expressed cautious optimism about the potential long-term benefits for students.', 'article-4-1616582091.webp', '2021-04-22', 1, 1),
(49, 4, 12, 'Research shows significant learning gaps post-pandemic', 'A comprehensive study reveals substantial learning losses among students due to prolonged school closures during the pandemic. The research highlights disparities in access to digital learning resources between urban and rural areas. Education experts recommend targeted intervention programs to help students catch up. Governments are considering extending academic years and introducing remedial classes to address these challenges.', 'article-4-1616582091.webp', '2021-05-04', 0, 1),
(50, 5, 4, 'Stock markets reach all-time high on positive economic indicators', 'Major stock indices closed at record levels today, buoyed by strong corporate earnings and optimistic economic forecasts. Banking and technology sectors led the rally with significant gains. Foreign institutional investors have pumped substantial capital into equities this quarter. Market analysts attribute this bullish trend to improving business sentiment and government policy reforms supporting growth.', 'article-5-1620564561.jpeg', '2021-04-25', 1, 1),
(51, 5, 5, 'Startup ecosystem attracts record venture capital funding', 'Indian startups raised over $10 billion in venture capital funding in the first quarter, marking a historic high. Technology-driven sectors including fintech, edtech, and healthtech dominated investment activity. Several companies achieved unicorn status, reflecting strong investor confidence in the entrepreneurial ecosystem. Industry leaders predict this momentum will continue as more international investors explore opportunities in emerging markets.', 'article-5-1620564561.jpeg', '2021-05-07', 1, 1),
(52, 6, 6, 'National cricket team announces squad for international tournament', 'The selection committee has unveiled the squad for the upcoming international cricket tournament featuring a mix of experienced players and promising newcomers. The team composition reflects a balanced approach with strong batting depth and varied bowling options. Fans have reacted positively to the inclusion of several young talents. The tournament is scheduled to begin next month at multiple venues.', 'article-6-1620565182.jpg', '2021-04-16', 0, 1),
(53, 6, 7, 'Olympic medalist announces retirement from professional sports', 'A decorated athlete who brought glory to the nation with multiple Olympic and World Championship medals has announced retirement after an illustrious 15-year career. The announcement came during an emotional press conference attended by family, coaches, and fellow athletes. Sports authorities plan to honor the champion with prestigious awards recognizing outstanding contributions to the sport. The athlete plans to focus on coaching and mentoring young talent.', 'article-6-1616581668.webp', '2021-04-29', 1, 1),
(54, 6, 8, 'New sports academy launches with world-class facilities', 'A state-of-the-art sports academy offering training in multiple disciplines opened its doors today. The facility features Olympic-standard infrastructure, experienced coaching staff, and sports science support. Young athletes from across the country can now access professional training programs previously available only abroad. The academy aims to nurture future champions and improve the nation\'s performance in international competitions.', 'article-6-1620565182.jpg', '2021-05-10', 0, 1),
(55, 6, 1, 'Football league announces expansion with new teams', 'The national football league has approved the addition of four new franchises for the upcoming season, expanding the tournament format and reach. This expansion is expected to boost grassroots football development and create opportunities for more players. Team owners have committed significant investments in player development and infrastructure. The league commissioner emphasized that this growth reflects the increasing popularity of football across the country.', 'article-6-1616581668.webp', '2021-05-14', 1, 1),
(56, 7, 9, 'Blockbuster film crosses 500 crore mark at box office', 'A highly anticipated movie has shattered box office records by crossing the 500 crore rupee mark within three weeks of release. The film\'s success is attributed to its compelling storyline, stellar performances, and high production values. It has performed exceptionally well both domestically and in international markets. Industry analysts predict it will become one of the highest-grossing films of all time.', 'article-7-1616581857.webp', '2021-04-19', 1, 1),
(57, 7, 10, 'Music streaming platform reports 100 million active users', 'A popular music streaming service has announced reaching 100 million active users in India, making it one of the largest markets globally. The platform attributes this growth to diverse content offerings, regional language support, and affordable subscription plans. New features including podcast hosting and live concert streaming have enhanced user engagement. The company plans to invest further in original content production and artist partnerships.', 'article-7-1616578778.png', '2021-05-06', 0, 1),
(58, 8, 11, 'Medical breakthrough offers hope for diabetes patients', 'Researchers have announced a significant advancement in diabetes treatment with the development of a new medication that shows promising results in clinical trials. The drug improves insulin sensitivity and helps maintain stable blood sugar levels with minimal side effects. Medical experts believe this could transform diabetes management for millions of patients. Regulatory approval processes are underway for making the treatment widely available.', 'article-8-1616578937.webp', '2021-04-21', 1, 1),
(59, 8, 12, 'Government launches nationwide health screening initiative', 'A comprehensive public health program aimed at early detection of non-communicable diseases was launched today. The initiative will provide free health screenings including tests for diabetes, hypertension, and cancer across all districts. Healthcare workers have been specially trained to conduct these screenings and provide counseling. Officials expect to screen over 50 million people in the first phase of this ambitious program.', 'article-8-1616578990.jpg', '2021-05-03', 0, 1),
(60, 8, 1, 'Mental health awareness campaign reaches rural communities', 'A national campaign to destigmatize mental health issues has successfully reached remote rural areas through community health workers and local influencers. The program provides information about common mental health conditions and available treatment options. Thousands of people have sought help through the helpline established as part of this initiative. Mental health professionals emphasize the importance of sustained efforts to change societal attitudes and improve access to care.', 'article-8-1620575059.jpg', '2021-05-09', 1, 1),
(61, 1, 2, 'Coalition government faces confidence vote in parliament', 'The ruling coalition government will face a crucial vote of confidence next week as opposition parties unite to challenge its majority. Political observers note that several smaller parties hold the key to the outcome. The government has initiated intensive negotiations to secure support from wavering allies. This development has created uncertainty in policy implementation and impacted financial markets.', 'article-1-1616580787.webp', '2021-05-15', 0, 1),
(62, 1, 3, 'Anti-corruption bureau arrests senior officials in major scandal', 'Multiple high-ranking government officials were arrested today in connection with a large-scale corruption case involving illegal land allocations. The investigation has been ongoing for several months and has uncovered evidence of systematic wrongdoing. Opposition parties have demanded a comprehensive inquiry into the matter. The arrests mark a significant step in addressing public concerns about transparency and accountability in governance.', 'article-1-1616582207.webp', '2021-05-18', 1, 1),
(63, 2, 4, 'Tech giant announces major data center investment', 'A global technology company has revealed plans to invest $5 billion in building three new data centers in the country over the next two years. This investment will create thousands of jobs and strengthen digital infrastructure. The company cited favorable government policies and growing demand for cloud services as key factors in this decision. Local technology sector leaders have welcomed this development as a boost to the digital economy.', 'article-2-1616580598.jpg', '2021-05-11', 1, 1),
(64, 2, 5, 'Quantum computing lab inaugurated at premier institute', 'A cutting-edge quantum computing research facility was inaugurated at a leading science institute today. The lab will focus on developing quantum algorithms and applications in cryptography, drug discovery, and optimization problems. This establishes the country as a serious player in quantum technology research. International collaboration agreements have been signed to advance research in this frontier area of science.', 'article-2-1620564684.webp', '2021-05-16', 0, 1),
(65, 3, 6, 'Celebrity chef opens sustainable farm-to-table restaurant', 'A renowned culinary expert has launched an innovative restaurant concept that sources ingredients exclusively from local organic farms. The menu changes seasonally based on available produce, ensuring maximum freshness and sustainability. This initiative also supports small farmers by providing them a direct market for their products. Food critics have praised both the concept and the exceptional quality of dishes served.', 'article-3-1616581072.jpg', '2021-05-13', 0, 1),
(66, 3, 7, 'Traditional sweet makers adapt to changing consumer preferences', 'Iconic sweet shops are reinventing traditional recipes to cater to health-conscious consumers by reducing sugar content and using natural ingredients. These adaptations maintain authentic flavors while addressing modern dietary concerns. The initiative has been well-received, with sales showing positive trends. Industry experts view this as a successful example of tradition meeting innovation in the food sector.', 'article-3-1616581173.jpg', '2021-05-19', 1, 1),
(67, 4, 8, 'Universities introduce innovative skill development programs', 'Leading universities have launched specialized programs focusing on industry-relevant skills including data analytics, digital marketing, and artificial intelligence. These courses are designed in collaboration with corporate partners to ensure curriculum alignment with job market demands. Students can earn certificates alongside their degrees, enhancing employability. Education experts believe this model bridges the gap between academic learning and practical skills.', 'article-4-1616582091.webp', '2021-05-17', 1, 1),
(68, 4, 9, 'Rural schools receive technology upgrade under government scheme', 'Thousands of rural schools have been equipped with computers, internet connectivity, and digital learning resources under a government initiative to bridge the urban-rural education divide. Teachers are receiving training in using educational technology effectively. Early feedback indicates improved student engagement and learning outcomes. The program will be expanded to cover all rural schools within the next year.', 'article-4-1616582091.webp', '2021-05-21', 0, 1),
(69, 5, 10, 'Central bank maintains interest rates amid inflation concerns', 'The monetary policy committee decided to keep key interest rates unchanged while closely monitoring inflation trends and economic recovery. The central bank governor emphasized the need to balance growth support with price stability. Financial markets responded positively to the announcement. Economists have mixed views on whether this stance will be sufficient to manage inflationary pressures.', 'article-5-1620564561.jpeg', '2021-05-20', 0, 1),
(70, 5, 11, 'E-commerce sector sees record sales during festival season', 'Online retailers reported unprecedented sales volumes during the recent festival shopping period, with transactions exceeding previous records by 60%. Electronics, fashion, and home appliances were the top-selling categories. The surge was driven by attractive discounts, convenient payment options, and improved delivery networks. Industry leaders credit increasing digital adoption across all demographics for this growth.', 'article-5-1620564561.jpeg', '2021-05-23', 1, 1),
(71, 6, 12, 'Women\'s cricket team achieves historic series victory', 'The national women\'s cricket team secured a memorable series win against a top-ranked opponent, showcasing exceptional skills and team spirit. Key players delivered outstanding performances across all matches. This victory has generated immense enthusiasm for women\'s cricket and is expected to inspire more young girls to take up the sport. Cricket authorities announced increased investment in women\'s cricket development programs.', 'article-6-1620565182.jpg', '2021-05-22', 1, 1),
(72, 6, 1, 'Marathon event attracts record number of participants', 'An annual marathon organized in the capital saw participation from over 50,000 runners, including international athletes and fitness enthusiasts. The event promoted health awareness and raised funds for charitable causes. Organizers ensured all safety protocols were followed, with medical teams stationed along the route. The overwhelming response has encouraged organizers to expand the event next year.', 'article-6-1616581668.webp', '2021-05-25', 0, 1),
(73, 7, 2, 'International film festival announces award winners', 'The prestigious international film festival concluded with the announcement of awards across various categories. Films addressing social issues received particular recognition from the jury. Emerging filmmakers were honored with special mentions for innovative storytelling. The festival showcased over 200 films from 60 countries, promoting cultural exchange and cinematic excellence.', 'article-7-1616581857.webp', '2021-05-24', 0, 1),
(74, 7, 3, 'Popular web series renewed for third season', 'A critically acclaimed web series has been officially renewed for a third season following massive viewer response and positive reviews. The show\'s creators announced new storylines that will further develop beloved characters. Streaming platforms have seen success with original content, and this renewal reflects changing consumption patterns. Production is expected to begin next month with release planned for early next year.', 'article-7-1616578778.png', '2021-05-26', 1, 1),
(75, 8, 4, 'Telemedicine adoption increases healthcare accessibility', 'Telemedicine services have witnessed exponential growth, particularly in remote areas with limited access to healthcare facilities. Patients can now consult specialists through video calls, receive prescriptions, and schedule follow-ups online. Healthcare providers have invested in digital infrastructure to support this transition. Studies show high patient satisfaction rates and improved health outcomes through timely medical intervention.', 'article-8-1616578937.webp', '2021-05-27', 1, 1),
(76, 8, 5, 'Vaccination drive achieves milestone with 500 million doses', 'The national immunization program reached a significant landmark by administering 500 million vaccine doses against COVID-19. The achievement reflects coordinated efforts by healthcare workers, administrators, and volunteers. Vaccination coverage has now been extended to younger age groups. Health officials remain committed to achieving universal vaccination coverage and have ramped up daily capacity.', 'article-8-1616578990.jpg', '2021-05-28', 1, 1),
(77, 1, 6, 'Supreme Court delivers landmark judgment on privacy rights', 'In a historic ruling, the apex court has strengthened constitutional protections for individual privacy rights in the digital age. The comprehensive judgment addresses concerns about data collection, surveillance, and citizen rights. Legal experts describe this as a watershed moment that will influence legislation and policies. The verdict has been widely welcomed by civil liberties organizations and technology companies alike.', 'article-1-1616580787.webp', '2021-06-01', 1, 1),
(78, 1, 7, 'Infrastructure development plan receives cabinet approval', 'The cabinet has approved an ambitious infrastructure development plan worth Rs 100,000 crores focusing on highways, railways, and ports. The multi-year project aims to boost economic growth and create employment opportunities. Implementation will begin immediately with priority given to critical connectivity projects. Economists predict this will have a significant multiplier effect on the overall economy.', 'article-1-1616582207.webp', '2021-06-05', 0, 1),
(79, 2, 8, 'Cybersecurity firm discovers major vulnerability in popular software', 'A leading cybersecurity company has identified a critical security flaw in widely-used software that could potentially expose millions of users to cyberattacks. The company has worked with software developers to release urgent patches. Users are being advised to update their systems immediately. This discovery highlights the ongoing challenges in maintaining digital security in an increasingly connected world.', 'article-2-1616580598.jpg', '2021-06-03', 0, 1),
(80, 2, 9, 'Artificial intelligence helps diagnose rare diseases accurately', 'Medical researchers have developed an AI-powered diagnostic tool that can identify rare diseases with remarkable accuracy by analyzing medical images and patient data. The technology assists doctors in making faster and more accurate diagnoses, potentially saving lives. Several hospitals have begun pilot programs to integrate this system into their diagnostic workflows. This represents a significant advancement in precision medicine.', 'article-2-1620564684.webp', '2021-06-08', 1, 1),
(81, 3, 10, 'Indigenous food practices gain recognition at culinary summit', 'A global culinary summit highlighted indigenous food practices and traditional cooking methods that promote sustainability and nutrition. Experts emphasized the importance of preserving culinary heritage while adapting to modern contexts. Traditional recipes using locally available ingredients were showcased, demonstrating their relevance to contemporary health and environmental concerns. The summit concluded with commitments to document and promote indigenous food knowledge.', 'article-3-1616581275.webp', '2021-06-10', 0, 1),
(82, 3, 11, 'Plant-based meat alternatives gain market traction', 'Consumer demand for plant-based meat alternatives has surged dramatically, driven by health and environmental considerations. Multiple startups and established food companies are launching innovative products that closely mimic the taste and texture of meat. Retail presence has expanded significantly with dedicated sections in supermarkets. Industry analysts project this segment will continue growing as more consumers explore sustainable protein options.', 'article-3-1616581072.jpg', '2021-06-13', 1, 1),
(83, 4, 12, 'Scholarship program supports underprivileged students', 'A comprehensive scholarship initiative was launched to support academically talented students from economically disadvantaged backgrounds. The program covers tuition fees, books, and living expenses for higher education. Over 10,000 students will benefit in the first year alone. Educational foundations and corporate sponsors have contributed significantly to make this possible, recognizing education as a pathway to social mobility.', 'article-4-1616582091.webp', '2021-06-12', 0, 1),
(84, 4, 1, 'Coding bootcamps address tech industry talent shortage', 'Intensive coding bootcamps have emerged as an effective solution to bridge the gap between tech industry hiring needs and available talent. These programs offer accelerated learning paths in software development, data science, and cybersecurity. Graduates report high placement rates with competitive salaries. Educational institutions are partnering with bootcamp providers to offer hybrid learning models combining theoretical foundations with practical skills.', 'article-4-1616582091.webp', '2021-06-15', 1, 1),
(85, 5, 2, 'Green bonds attract institutional investors', 'The government\'s issuance of green bonds to finance renewable energy and sustainable infrastructure projects has received overwhelming response from institutional investors. The bonds were oversubscribed within hours of opening. This reflects growing investor interest in environmentally responsible investment opportunities. Financial experts view this as an important step in mobilizing capital for climate action and sustainable development goals.', 'article-5-1620564561.jpeg', '2021-06-14', 1, 1),
(86, 5, 3, 'Retail inflation shows signs of moderation', 'Latest economic data indicates that retail inflation has begun moderating after several months of elevated levels. Food prices, which constitute a significant portion of the consumer price index, have stabilized. Economists attribute this to improved supply chains and favorable agricultural output. The central bank may consider this development in future monetary policy decisions regarding interest rates.', 'article-5-1620564561.jpeg', '2021-06-18', 0, 1),
(87, 6, 4, 'Young chess prodigy wins international championship', 'A teenage chess player has created history by winning a prestigious international championship, defeating several grandmasters. The remarkable achievement has brought attention to India\'s growing strength in chess. The player credited structured training, mental conditioning, and family support for this success. Chess academies across the country have seen increased enrollment following this inspiring victory.', 'article-6-1620565182.jpg', '2021-06-16', 1, 1),
(88, 6, 5, 'National sports federation announces grassroots development initiative', 'A comprehensive program to identify and nurture young athletic talent at the grassroots level has been launched across all districts. The initiative includes infrastructure development, coaching camps, and sports science support. Emphasis is placed on discovering talent from rural and tribal areas. Federation officials believe this systematic approach will strengthen the pipeline of athletes for future international competitions.', 'article-6-1616581668.webp', '2021-06-20', 0, 1),
(89, 1, 8, 'Parliamentary session concludes with key legislation passed', 'The monsoon session of Parliament concluded today after passing several important bills including labor reforms and industrial relations code. The session witnessed intense debates on agricultural policies and economic recovery measures. Government leaders highlighted the productive nature of discussions despite opposition protests on certain issues. The next session is scheduled to begin in three months to address pending legislation.', 'article-1-1616580787.webp', '2021-06-22', 0, 1),
(90, 1, 9, 'Border security enhanced with advanced surveillance systems', 'The government has approved the deployment of cutting-edge surveillance technology along sensitive border areas to strengthen national security. The new systems include thermal imaging cameras, drones, and AI-powered monitoring stations. Defense officials believe this technological upgrade will significantly improve threat detection capabilities. The installation process is expected to be completed within the next six months.', 'article-1-1616582207.webp', '2021-06-25', 1, 1),
(91, 2, 11, 'Semiconductor manufacturing plant to boost domestic production', 'A major electronics company announced plans to establish a semiconductor manufacturing facility with an investment of Rs 30,000 crores. The plant will produce chips for smartphones, computers, and automotive applications. This initiative aligns with the government\'s vision to reduce dependency on imports and create a robust domestic semiconductor ecosystem. The facility is expected to generate over 15,000 jobs when fully operational.', 'article-2-1616580598.jpg', '2021-06-23', 1, 1),
(92, 2, 12, 'Cloud computing adoption accelerates among enterprises', 'Businesses across sectors are rapidly migrating to cloud-based infrastructure to enhance operational efficiency and reduce costs. Industry reports indicate a 70% increase in cloud adoption compared to last year. Small and medium enterprises are particularly benefiting from the scalability and flexibility offered by cloud solutions. Technology providers are expanding their data center networks to meet growing demand.', 'article-2-1620564684.webp', '2021-06-27', 0, 1),
(93, 2, 1, 'Mobile payment transactions reach record high', 'Digital payment platforms processed over 500 crore transactions this month, marking a new milestone in the country\'s cashless economy journey. The surge is attributed to increased smartphone penetration and user-friendly payment interfaces. Government incentives for digital transactions have also played a significant role. Financial analysts predict this trend will continue as more merchants adopt digital payment systems.', 'article-2-1616580598.jpg', '2021-06-29', 1, 1),
(94, 3, 3, 'Organic farming gains popularity among urban consumers', 'Demand for organically grown produce has witnessed substantial growth in metropolitan areas as health-conscious consumers prioritize chemical-free food. Farmers markets and online platforms specializing in organic products have seen increased footfall and orders. Agricultural experts note that this trend is encouraging more farmers to adopt sustainable farming practices. Premium pricing for organic produce is providing better income opportunities for farmers.', 'article-3-1616581275.webp', '2021-06-24', 0, 1),
(95, 3, 4, 'Regional food festivals showcase authentic local cuisines', 'A series of food festivals celebrating regional culinary traditions have been organized across major cities. These events provide platforms for local chefs and home cooks to present authentic dishes prepared using traditional methods. Food enthusiasts appreciate the opportunity to experience diverse flavors and learn about cultural food heritage. Organizers plan to expand the festival circuit to smaller towns next year.', 'article-3-1616581072.jpg', '2021-06-28', 1, 1),
(96, 3, 5, 'Cloud kitchens revolutionize food delivery business', 'The cloud kitchen model has transformed the restaurant industry by enabling entrepreneurs to operate delivery-only food businesses with minimal overhead costs. Multiple brands can operate from a single kitchen facility, offering diverse cuisines to customers. Investment in cloud kitchens has increased significantly as investors recognize the scalability of this business model. Industry experts predict continued growth in this segment.', 'article-3-1616581173.jpg', '2021-07-02', 0, 1),
(97, 4, 6, 'Digital literacy programs reach rural communities', 'A nationwide initiative to promote digital literacy in rural areas has successfully trained over 1 million people in basic computer skills and internet usage. The program focuses on practical applications including online banking, government services, and educational resources. Community centers equipped with computers and internet connectivity serve as training hubs. Participants report increased confidence in accessing digital services.', 'article-4-1616582091.webp', '2021-06-26', 1, 1),
(98, 4, 7, 'Universities collaborate with industry for research projects', 'Leading academic institutions have formed partnerships with corporate organizations to conduct collaborative research in emerging technologies. These alliances facilitate knowledge exchange and provide students with exposure to real-world challenges. Research outcomes are expected to contribute to innovation and product development. Funding from industry partners enables universities to upgrade laboratory facilities and equipment.', 'article-4-1616582091.webp', '2021-06-30', 0, 1),
(99, 4, 8, 'Vocational training programs boost youth employability', 'Skill development centers offering vocational training in trades like carpentry, electrical work, and hospitality have reported high success rates in job placements. The programs combine classroom instruction with hands-on training, preparing youth for immediate employment. Government certification adds credibility to the training, making graduates attractive to employers. Expansion plans include adding courses in emerging sectors.', 'article-4-1616582091.webp', '2021-07-04', 1, 1),
(100, 5, 9, 'Banking sector reports strong quarterly earnings', 'Major banks have announced impressive financial results for the quarter, driven by robust credit growth and improved asset quality. Non-performing assets have declined, indicating better risk management. Banks are expanding their lending to priority sectors including agriculture and small businesses. Financial analysts maintain a positive outlook for the banking sector based on economic recovery indicators.', 'article-5-1620564561.jpeg', '2021-07-01', 1, 1),
(101, 5, 10, 'Insurance penetration increases in tier-2 and tier-3 cities', 'Insurance companies have witnessed significant policy sales growth in smaller cities and towns as awareness about financial protection increases. Life insurance, health insurance, and vehicle insurance segments have all registered healthy growth. Digital distribution channels have made insurance products more accessible. Industry leaders are investing in expanding their presence in emerging markets.', 'article-5-1620564561.jpeg', '2021-07-05', 0, 1),
(102, 5, 11, 'Real estate sector shows signs of recovery', 'Housing sales in major cities have picked up momentum with demand driven by attractive pricing and low interest rates. Developers are launching new projects targeting the mid-income segment. Government incentives for homebuyers have stimulated market activity. Real estate analysts believe the recovery will gain further strength in the coming quarters as employment prospects improve.', 'article-5-1620564561.jpeg', '2021-07-08', 0, 1),
(103, 6, 12, 'National badminton tournament showcases emerging talent', 'The recently concluded national badminton championship featured impressive performances from young players who demonstrated world-class skills. Several unseeded players reached advanced rounds, surprising established champions. Coaches identified multiple prospects for international tournaments. The tournament\'s success has generated enthusiasm for badminton at the grassroots level.', 'article-6-1620565182.jpg', '2021-07-03', 0, 1),
(104, 6, 2, 'Hockey team prepares for international tournament', 'The national hockey team has entered an intensive training camp ahead of a major international tournament. The squad includes experienced players and promising newcomers selected through rigorous trials. Coaching staff has designed specialized training modules focusing on fitness, strategy, and team coordination. Players express confidence about delivering strong performances in the tournament.', 'article-6-1616581668.webp', '2021-07-07', 1, 1),
(105, 6, 3, 'Athletics federation announces coaching excellence program', 'A comprehensive initiative to enhance coaching standards in athletics has been launched with support from international experts. The program will train coaches in modern training methods, sports science, and athlete development. Selected coaches will receive certifications recognized globally. Federation officials believe this investment in coaching quality will translate into improved athlete performance.', 'article-6-1620565182.jpg', '2021-07-10', 0, 1),
(106, 7, 4, 'Regional cinema gains recognition at national film awards', 'Regional language films dominated the national film awards this year, with multiple awards for best film, direction, and performances. The awards highlighted the rich storytelling traditions and technical excellence of regional cinema. Industry observers note the growing appreciation for diverse linguistic and cultural narratives. Streaming platforms are increasingly investing in regional content production.', 'article-7-1616581857.webp', '2021-07-06', 1, 1),
(107, 7, 5, 'Music concerts return with live audiences', 'After a prolonged hiatus, live music concerts have resumed with audiences experiencing the energy of in-person performances. Artists and fans alike expressed joy at the return of live entertainment. Venues are implementing safety protocols while ensuring memorable experiences. Ticket sales indicate strong demand for concerts across musical genres.', 'article-7-1616578778.png', '2021-07-09', 0, 1),
(108, 7, 6, 'Animation industry attracts global collaborations', 'Indian animation studios are partnering with international production houses on major projects, showcasing the country\'s creative and technical capabilities. The industry has evolved significantly with investments in technology and talent development. Animation professionals find opportunities in films, series, gaming, and advertising. Industry leaders project continued growth with expanding global demand.', 'article-7-1616581857.webp', '2021-07-12', 1, 1),
(109, 8, 7, 'Ayurveda wellness centers gain popularity', 'Traditional Ayurvedic wellness centers offering holistic health treatments have seen increased patronage from people seeking natural healing methods. Treatments include Panchakarma therapies, herbal medicines, and lifestyle consultations. Medical practitioners acknowledge the complementary role of Ayurveda in preventive healthcare. Centers are expanding facilities to accommodate growing demand.', 'article-8-1616578937.webp', '2021-07-11', 0, 1),
(110, 8, 8, 'Blood donation drives organized across cities', 'Voluntary blood donation campaigns conducted in multiple cities have successfully collected thousands of units to replenish blood bank reserves. Healthcare organizations and volunteers coordinated the drives at schools, colleges, and community centers. Donors emphasized the importance of regular blood donation in saving lives. Organizers plan to conduct such drives quarterly to ensure adequate blood supply.', 'article-8-1616578990.jpg', '2021-07-14', 1, 1),
(111, 8, 9, 'Yoga and meditation programs promote mental wellness', 'Corporate organizations and educational institutions are incorporating yoga and meditation sessions to support mental health and stress management. Participants report improved concentration, reduced anxiety, and better work-life balance. Certified instructors conduct regular sessions tailored to different age groups and fitness levels. The practice has gained acceptance as an effective wellness intervention.', 'article-8-1620575059.jpg', '2021-07-17', 0, 1),
(112, 1, 10, 'Local governance reforms empower municipalities', 'New legislation granting greater autonomy and resources to municipal bodies has been implemented to strengthen local governance. The reforms enable cities to plan and execute development projects more efficiently. Urban development experts view this as a positive step toward decentralized administration. Municipalities are preparing strategic plans to utilize the enhanced powers effectively.', 'article-1-1616580787.webp', '2021-07-15', 0, 1),
(113, 1, 11, 'Diplomatic relations strengthen with neighboring countries', 'High-level bilateral meetings between government officials have resulted in agreements on trade, security cooperation, and cultural exchanges. The discussions addressed regional challenges and explored opportunities for mutual benefit. Diplomatic observers consider these developments significant for regional stability and economic integration. Follow-up meetings are scheduled to implement the agreed frameworks.', 'article-1-1616582207.webp', '2021-07-19', 1, 1),
(114, 2, 2, 'Robotics competition inspires student innovators', 'A national robotics competition for students showcased creative engineering solutions addressing real-world problems. Participating teams demonstrated robots capable of performing tasks in agriculture, healthcare, and disaster management. Judges praised the innovative thinking and technical skills displayed. The competition aims to encourage STEM education and cultivate future technology leaders.', 'article-2-1620564684.webp', '2021-07-16', 1, 1),
(115, 2, 3, 'Internet connectivity improves in remote areas', 'Telecommunications companies have expanded broadband and mobile internet services to previously underserved remote regions. The improved connectivity enables residents to access online education, telemedicine, and e-commerce services. Government initiatives supporting infrastructure development have facilitated this expansion. Communities report positive impacts on education and economic opportunities.', 'article-2-1616580598.jpg', '2021-07-20', 0, 1),
(116, 3, 10, 'Sustainable packaging solutions gain industry adoption', 'Food and beverage companies are transitioning to eco-friendly packaging materials to reduce environmental impact. Biodegradable and recyclable packaging options are replacing traditional plastic packaging. Consumer preference for sustainable products is driving this shift. Industry associations are collaborating on standards and best practices for sustainable packaging.', 'article-3-1616581072.jpg', '2021-07-18', 1, 1),
(117, 3, 11, 'Cooking shows inspire home chefs nationwide', 'Television cooking shows featuring celebrity chefs and home cooks have become extremely popular, inspiring viewers to experiment with new recipes and techniques. Social media platforms are filled with home chefs sharing their culinary creations. The shows promote diverse cuisines and healthy cooking methods. Food industry professionals note increased interest in culinary education and kitchen equipment.', 'article-3-1616581173.jpg', '2021-07-21', 0, 1),
(118, 4, 12, 'Teacher training programs enhance classroom effectiveness', 'Comprehensive professional development programs for teachers focus on modern pedagogical methods, technology integration, and student-centered learning approaches. Trained teachers report improved student engagement and learning outcomes. The programs include workshops, mentoring, and online resources. Education departments are scaling up training initiatives to reach teachers in all schools.', 'article-4-1616582091.webp', '2021-07-23', 0, 1),
(119, 5, 1, 'Microfinance institutions support rural entrepreneurship', 'Microfinance organizations providing small loans to rural entrepreneurs have enabled thousands to start businesses ranging from dairy farming to handicrafts. The loan repayment rates demonstrate the reliability and determination of rural borrowers. Success stories include women entrepreneurs who have transformed their families\' economic status. Expansion of microfinance services continues in underserved areas.', 'article-5-1620564561.jpeg', '2021-07-22', 1, 1),
(120, 6, 4, 'Table tennis academy produces international medalists', 'A specialized table tennis training academy has successfully developed players who have won medals at international competitions. The academy\'s systematic approach combines technical training, mental conditioning, and competitive exposure. Young players receive scholarships based on talent and potential. The success has attracted aspiring players from across the country to enroll in the program.', 'article-6-1620565182.jpg', '2021-07-25', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(35) NOT NULL,
  `author_password` varchar(100) NOT NULL,
  `author_email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_name`, `author_password`, `author_email`) VALUES
(1, 'Suyash U', '$2y$10$xDw4C1y58k8kafvdzKo6WO/XglvO9jeJV7evQTxfOSxJ8DybuXDFW', 'suyash@suyash.com'),
(2, 'U Anish', '$2y$10$gD8OeQmEZBbQFnO2CCpoBeot5X2/D76qV/ej5q1yyXkCmTilG6LHy', 'anish@anish.com'),
(3, 'Varshini Senthil', '$2y$10$yfqAfNTZiiGgStBU9089rOysv0n35bqk9t.M/tjC/H2ahfmPedoyS', 'vari@vari.com'),
(4, 'Nivethitha V S', '$2y$10$ETC53l2u7pyzCfbwsQMzcOzvVln2gEimQOIG7wVgM/vw.ouCb0FM.', 'nivi@nivi.com'),
(5, 'Rahul Sharma', '$2y$10$abc123def456ghi789jklmno012pqr345stu678vwx901yz234abc567', 'rahul.sharma@newsportal.com'),
(6, 'Priya Patel', '$2y$10$def456ghi789jklmno012pqr345stu678vwx901yz234abc567def890', 'priya.patel@newsportal.com'),
(7, 'Amit Kumar', '$2y$10$ghi789jklmno012pqr345stu678vwx901yz234abc567def890ghi123', 'amit.kumar@newsportal.com'),
(8, 'Sneha Reddy', '$2y$10$jklmno012pqr345stu678vwx901yz234abc567def890ghi123jkl456', 'sneha.reddy@newsportal.com'),
(9, 'Vikram Singh', '$2y$10$mno012pqr345stu678vwx901yz234abc567def890ghi123jkl456mno789', 'vikram.singh@newsportal.com'),
(10, 'Deepika Iyer', '$2y$10$pqr345stu678vwx901yz234abc567def890ghi123jkl456mno789pqr012', 'deepika.iyer@newsportal.com'),
(11, 'Arjun Mehta', '$2y$10$stu678vwx901yz234abc567def890ghi123jkl456mno789pqr012stu345', 'arjun.mehta@newsportal.com'),
(12, 'Kavita Nair', '$2y$10$vwx901yz234abc567def890ghi123jkl456mno789pqr012stu345vwx678', 'kavita.nair@newsportal.com');

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `bookmark_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`bookmark_id`, `user_id`, `article_id`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 1, 6),
(4, 1, 7),
(5, 1, 17),
(6, 1, 19),
(7, 1, 28),
(8, 1, 37),
(9, 2, 1),
(10, 2, 4),
(11, 2, 7),
(12, 2, 20),
(13, 2, 29),
(14, 4, 6),
(15, 4, 19),
(16, 4, 37),
(17, 4, 38),
(18, 5, 1),
(19, 5, 39),
(20, 5, 41),
(21, 6, 4),
(22, 6, 28),
(23, 6, 29),
(24, 6, 40),
(25, 6, 42),
(26, 7, 39),
(27, 7, 43),
(28, 7, 48),
(29, 8, 41),
(30, 8, 44),
(31, 8, 50),
(32, 9, 42),
(33, 9, 45),
(34, 9, 52),
(35, 10, 43),
(36, 10, 46),
(37, 10, 53),
(38, 11, 44),
(39, 11, 47),
(40, 11, 56),
(41, 12, 45),
(42, 12, 48),
(43, 12, 58),
(44, 13, 50),
(45, 13, 60),
(46, 13, 61),
(47, 14, 51),
(48, 14, 62),
(49, 14, 63),
(50, 15, 52),
(51, 15, 64),
(52, 15, 65),
(53, 16, 53),
(54, 16, 66),
(55, 16, 67),
(56, 17, 54),
(57, 17, 68),
(58, 17, 70),
(59, 18, 55),
(60, 18, 71),
(61, 18, 73),
(62, 19, 56),
(63, 19, 74),
(64, 19, 75),
(65, 20, 57),
(66, 20, 76),
(67, 20, 77),
(68, 21, 58),
(69, 21, 78),
(70, 21, 80),
(71, 22, 59),
(72, 22, 81),
(73, 22, 82),
(74, 23, 60),
(75, 23, 83),
(76, 23, 85),
(77, 24, 61),
(78, 24, 84),
(79, 24, 86),
(80, 25, 62),
(81, 25, 87),
(82, 25, 88),
(83, 1, 89),
(84, 1, 90),
(85, 2, 91),
(86, 2, 92),
(87, 3, 93),
(88, 4, 94),
(89, 4, 95),
(90, 5, 96),
(91, 5, 97),
(92, 6, 98),
(93, 7, 99),
(94, 7, 100),
(95, 8, 101),
(96, 9, 102),
(97, 9, 103),
(98, 10, 104),
(99, 10, 105),
(100, 11, 106),
(101, 11, 107),
(102, 12, 108),
(103, 13, 109),
(104, 13, 110),
(105, 14, 111),
(106, 14, 112),
(107, 15, 113),
(108, 15, 114),
(109, 16, 115),
(110, 16, 116),
(111, 17, 117),
(112, 17, 118),
(113, 18, 119),
(114, 18, 120),
(115, 19, 90),
(116, 19, 93),
(117, 20, 95),
(118, 20, 100),
(119, 21, 106),
(120, 21, 110),
(121, 22, 113),
(122, 22, 114),
(123, 23, 104),
(124, 23, 108),
(125, 24, 115),
(126, 24, 119),
(127, 25, 120),
(128, 25, 116),
(129, 1, 91),
(130, 2, 94),
(131, 2, 96),
(132, 3, 97),
(133, 3, 98),
(134, 4, 99),
(135, 4, 101),
(136, 5, 102),
(137, 5, 103),
(138, 6, 105),
(139, 6, 107),
(140, 7, 109),
(141, 8, 111),
(142, 8, 112),
(143, 9, 89),
(144, 9, 92),
(145, 10, 94),
(146, 10, 96);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(45) NOT NULL,
  `category_color` varchar(35) NOT NULL,
  `category_image` varchar(250) NOT NULL,
  `category_description` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_color`, `category_image`, `category_description`) VALUES
(1, 'Politics', 'tag-brown', 'Politics1616565135.jpg', 'Get a grip of the intriguing situation of Indian politics and where exactly our country is going under the leadership of our current leaders.'),
(2, 'Technology', 'tag-orange', 'Technology1616565177.jpg', 'World is changing rapidly because of the development of technology and boom in the need for technology, because nothing can be done without technology in today\'s world. So be up to date on the latest developments.'),
(3, 'Food', 'tag-purple', 'Food1616565209.jpg', 'Take a tour around the world\'s culinary deliciousness. Let yourself get melted in the taste and aroma for the food that we bring to you from every cuisine the world has seen.'),
(4, 'Education', 'tag-yellow', 'Education1616565234.jpg', 'Education is everything to survive in this competetive world. what is the latest when it comes to education and need to get education to every part of the world and the poor.'),
(5, 'Business', 'tag-pink', 'Business1620564308.jpg', 'Rise and Fall it\'s a roller coaster ride, the stock market. Bussines booming on a large scale and small handicraft artists making a livelihood. Stories from all around the world on business and trade.'),
(6, 'Sports', 'tag-purple', 'Sports1616565300.jpg', 'And it\'s a six or GOALLL!!!! are a few things that make us feel like a child. Sports, tournaments and league matches, where is each team standing, what is new in the world of sports??'),
(7, 'Entertainment', 'tag-orange', 'Entertainment1620564450.jpg', 'ROLL. CAMERA. ACTION. Behold the drama unfold in the coolest way possible. Catch your favorite celebrities on their new projects and endorsements.'),
(8, 'Health', 'tag-yellow', 'Health1616565475.jpg', 'One of human beings\' major asset is our ability of take care of our health and be healthy. our first priority should be to be healthy. COVID-19 LATEST NEWS AVAILABLE HERE.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(35) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Anish U ', 'anish@anish.com', '$2y$10$gD8OeQmEZBbQFnO2CCpoBeot5X2/D76qV/ej5q1yyXkCmTilG6LHy'),
(2, 'Jaishri S K', 'jai@jai.com', '$2y$10$CIVnTItR2cIxuLm4/zGjuOIfsh/Dqs/zaKOJ2ST4dIk0YrJF/Cam6'),
(4, 'Suyash U', 'suyash@suyash.com', '$2y$10$xDw4C1y58k8kafvdzKo6WO/XglvO9jeJV7evQTxfOSxJ8DybuXDFW'),
(5, 'Varshini Senthil', 'vari@vari.com', '$2y$10$yfqAfNTZiiGgStBU9089rOysv0n35bqk9t.M/tjC/H2ahfmPedoyS'),
(6, 'Nivethitha V S', 'nivi@nivi.com', '$2y$10$ETC53l2u7pyzCfbwsQMzcOzvVln2gEimQOIG7wVgM/vw.ouCb0FM.'),
(7, 'Rajesh Krishnan', 'rajesh.k@email.com', '$2y$10$abc123def456ghi789jklmno012pqr345stu678vwx901yz234abc567'),
(8, 'Meera Srinivasan', 'meera.s@email.com', '$2y$10$def456ghi789jklmno012pqr345stu678vwx901yz234abc567def890'),
(9, 'Karthik Venkat', 'karthik.v@email.com', '$2y$10$ghi789jklmno012pqr345stu678vwx901yz234abc567def890ghi123'),
(10, 'Lakshmi Balan', 'lakshmi.b@email.com', '$2y$10$jklmno012pqr345stu678vwx901yz234abc567def890ghi123jkl456'),
(11, 'Ravi Mohan', 'ravi.m@email.com', '$2y$10$mno012pqr345stu678vwx901yz234abc567def890ghi123jkl456mno789'),
(12, 'Pooja Desai', 'pooja.d@email.com', '$2y$10$pqr345stu678vwx901yz234abc567def890ghi123jkl456mno789pqr012'),
(13, 'Suresh Pillai', 'suresh.p@email.com', '$2y$10$stu678vwx901yz234abc567def890ghi123jkl456mno789pqr012stu345'),
(14, 'Divya Rao', 'divya.r@email.com', '$2y$10$vwx901yz234abc567def890ghi123jkl456mno789pqr012stu345vwx678'),
(15, 'Arun Nambiar', 'arun.n@email.com', '$2y$10$yz234abc567def890ghi123jkl456mno789pqr012stu345vwx678yz901'),
(16, 'Swati Joshi', 'swati.j@email.com', '$2y$10$234abc567def890ghi123jkl456mno789pqr012stu345vwx678yz901234'),
(17, 'Manoj Kapoor', 'manoj.k@email.com', '$2y$10$abc567def890ghi123jkl456mno789pqr012stu345vwx678yz901234abc'),
(18, 'Anjali Gupta', 'anjali.g@email.com', '$2y$10$567def890ghi123jkl456mno789pqr012stu345vwx678yz901234abc567'),
(19, 'Prakash Menon', 'prakash.m@email.com', '$2y$10$def890ghi123jkl456mno789pqr012stu345vwx678yz901234abc567def'),
(20, 'Shreya Iyer', 'shreya.i@email.com', '$2y$10$890ghi123jkl456mno789pqr012stu345vwx678yz901234abc567def890'),
(21, 'Naveen Kumar', 'naveen.k@email.com', '$2y$10$ghi123jkl456mno789pqr012stu345vwx678yz901234abc567def890ghi'),
(22, 'Radha Krishnan', 'radha.k@email.com', '$2y$10$123jkl456mno789pqr012stu345vwx678yz901234abc567def890ghi123'),
(23, 'Harish Reddy', 'harish.r@email.com', '$2y$10$jkl456mno789pqr012stu345vwx678yz901234abc567def890ghi123jkl'),
(24, 'Neha Sharma', 'neha.s@email.com', '$2y$10$456mno789pqr012stu345vwx678yz901234abc567def890ghi123jkl456'),
(25, 'Sanjay Malhotra', 'sanjay.m@email.com', '$2y$10$mno789pqr012stu345vwx678yz901234abc567def890ghi123jkl456mno');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`bookmark_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `bookmark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
