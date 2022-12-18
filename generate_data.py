import random
import csv

					## structure of data for each house ##
#* [hid, price, style, bedrooom_num, address, zip_code, area_type, lot_size, school_district, heating, air_conditioning, exterior_color, materials, garage_num, basement, extra_item] *#

fields = ["hid", "price", "style", "bedroom_num", "address", "zip_code", "area_type", "lot_size", "school_district", "heating", "air_conditioning", "exterior_color", "materials", "garage_num", "basement", "extra_item"]


area_types = ["rural", "suburban", "urban"]
prices     = [100000, 150000, 200000, 250000, 300000, 350000, 400000, 450000, 500000, 600000]
styles     = ["Colonial", "Ranch", "Split-level", "Modern", "Rustic"]
lot_sizes  = [.5, 1, 1.5, 1.75, 2, 3, 5]
zip_codes  = [16509, 16441, 15219, 18536, 18931, 21849]
schools    = ["North School District", "South School District", "East School District", "West School District", "Northeast School District", "Northwest School District", "Southeast School District", "Southwest School District"]
streets    = ["Main", "Mean", "Crown", "Long", "North", "South", "East", "West", "Fair", "Life", "Moon", "Sunshine", "Coast", "High", "Low", "Left", "Right", "Top", "Bottom", "Mouse" ]
heating    = ["coal", "wood", "gas", "electric"]
air_c      = ["window", "central", "mini-split"]
colors     = ["white", "black", "baige", "blue", "green"]
#use random number between 1 and 5 for garage num
materials  = ["wood", "brick", "steel", "concrete", "stone"]
basements  = ["none", "crawl space", "full but unfinished", "full and finished"]
extras     = ["none", "water purification system", "beautiful view", "on water", "home office", "pool"]


def generate_data(n):
	#all_houses = [[0 for j in range(16)] for i in range(n)]
	
	house_data         = [[0 for j in range(4)] for i in range(n)]
	location_data      = [[0 for j in range(6)] for i in range(n)]
	appliance_data     = [[0 for j in range(3)] for i in range(n)]
	construction_data  = [[0 for j in range(5)] for i in range(n)]
	extra_data         = [[0 for j in range(2)] for i in range(n)]	

	#print(all_houses)
	for i in range(n):
		house_data[i][0]  = i
		house_data[i][1]  = random.choice(prices)
		house_data[i][2]  = random.choice(styles)
		house_data[i][3]  = str(random.randint(1, 6))

		location_data[i][0]  = i
		location_data[i][1]  = str(random.randint(0, 5000)) + ' ' + random.choice(streets)
		location_data[i][2]  = random.choice(zip_codes)
		location_data[i][3]  = random.choice(area_types)
		location_data[i][4]  = random.choice(lot_sizes)
		location_data[i][5]  = random.choice(schools)

		appliance_data[i][0] = i
		appliance_data[i][1] = random.choice(heating)
		appliance_data[i][2] = random.choice(air_c)

		construction_data[i][0] = i
		construction_data[i][1] = random.choice(colors)
		construction_data[i][2] = random.choice(materials)
		construction_data[i][3] = str(random.randint(1, 5))
		construction_data[i][4] = random.choice(basements)

		extra_data[i][0] = i
		extra_data[i][1] = random.choice(extras)
	
	return [house_data, location_data, appliance_data, construction_data, extra_data]



def write_data():
	
	data = generate_data(200)

	##first write to houses csv file
	house_fields = fields[:4]
	house_data = data[0]
	
	with open('house_data.csv', 'w') as f:
		write = csv.writer(f)
		write.writerow(house_fields)
		write.writerows(house_data)

	
	##next write to locations csv file
	locations_fields = ["hid"] + fields[4:9]
	location_data = data[1]
	
	with open('location_data.csv', 'w') as f:
		write = csv.writer(f)
		write.writerow(locations_fields)
		write.writerows(location_data)
	
	##next write to appliances csv file
	appliances_fields = ["hid"] + fields[9:11]
	appliance_data = data[2]
	
	with open('appliance_data.csv', 'w') as f:
		write = csv.writer(f)
		write.writerow(appliances_fields)
		write.writerows(appliance_data)

	
	##next write to construction csv file
	construction_fields = ["hid"] + fields[11:15]
	construction_data = data[3]

	with open('construction_data.csv', 'w') as f:
		write = csv.writer(f)
		write.writerow(construction_fields)
		write.writerows(construction_data)
	
	##Last write to extras csv file
	extra_fields = ["hid"] + fields[15:]
	extra_data = data[4]

	with open('extra_data.csv', 'w') as f:
		write = csv.writer(f)
		write.writerow(extra_fields)
		write.writerows(extra_data)


