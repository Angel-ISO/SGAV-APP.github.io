const opc = {
    "GET": () => getDataAll(),
    "PUT": (data) => putData(data),
    "DELETE": (data) => deleteData(data),
    "SEARCH": (data) => searchData(data),
    "POST": (data) => postData(data)
}

let config = {
    headers:new Headers({
        "Content-Type": "application/json"
    }), 
};
const getDataAll = async()=>{
    config.method = "GET";
    let res = await ( await fetch("http://localhost:3000/customer",config)).json();
    return res;
}
const postData = async(data)=>{
    config.method = "POST";
    config.body = JSON.stringify(data);
    let res = await (await fetch ("http://localhost:3000/customer",config)).json();
    return res
}
const putData = async(data)=>{
    config.method = "PUT";
    config.body = JSON.stringify(data);
    let res = await ( await fetch(`http://localhost:3000/customer/${data.id}`,config)).json();
    console.log(res);
}
const deleteData = async(data)=>{
    config.method = "DELETE";
    let res = await ( await fetch(`http://localhost:3000/customer/${data.id}`,config)).json();
    console.log(res);
}
const searchData = async(data)=>{
    config.method = "GET";
    let res = await ( await fetch(`http://localhost:3000/customer?q=${Object.values(data).join("")}`,config)).json();
    console.log(res);
}
const searchDataById = async(id)=>{
    config.method = "GET";
    let res = await ( await fetch(`http://localhost:3000/customer/${id}`,config)).json();
    console.log(id);
    return res;
}


export{
    getDataAll,
    postData,
    putData,
    deleteData,
    searchData,
    searchDataById,
    opc 
}