The Problem
At the height of the Covid-19 pandemic, the public health system was functioning at their capacity as they always have. During this special time, public health workers, even those who are not frontliners, are exposed to more risk than is necessary. Patients arrive early or on time for their appointments, but often wait hours to be seen and even longer when other procedures are involved. Hundreds of patients and health workers cramp in their little badly-ventilated clinics for hours on end, putting everyone at risk of catching the airborne coronavirus.

Public health workers are humans like you and me. They have families too, and they are afraid of bringing the coronavirus home, like everybody else. So how do we minimise their exposure and risk?




The Constraints
An ophthalmologist came up to me and asked if I could build a system that could allow patients to wait in their cars or somewhere outdoors. She wanted to allow for physical distancing and help make their hospital safer for staff. Being a public hospital, this was something the hospital staff wanted to implement, so there wasn't any budget for it. 

The system needed to be 
- Free
- Doesn't require any infrastructure
- Easy to install
- Easy to use




The Solution
In 3 weeks, I built a queue system that allows patients to wait outside the hospital, reducing the number of patients in the hospital at any given time. 

The system fulfils all the constraints:
- Hosted on heroku (free)
- Server-less (doesn't require infrastructure)
- Mobile-first site (no installation, works on any phone or web browser)
- Only requires patients to input their queue number (easy to use)

A simple overview of the flow (in addition to whatever flow is already in place):
- Patient arrives at hospital reception
- Clerk enters queue number into system
- Patient leaves hospital to wait outside
- Patient goes to website and keys in queue number
- Patient sees that there are 10 more queue numbers before him
- Patient leaves website
- Patient receives notification on phone 10 minutes prior to estimated time to be served
- Patient returns to hospital and waits a short while to be seen by doctor



Made for: The wonderful  and brave doctors at Hospital Sultan Ismail (Ophthalmology).
Live demo:http://hsi-ophthalmology.herokuapp.com/

If you'd like to use this at any hospitals, clinics, eateries, or anywhere at all that could help reduce the risk of Covid-19, please do so. Credit is not necessary, just be sure to share your stories of how and who this system helped so I can feel more like a Covid-19 mini-hero!
