import { useForm } from '@inertiajs/react';

export default function Upload({ avatar, file }) {
    const { data, setData, post, processing, errors, progress } = useForm({
        avatar: null,
        file: null,
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('product.upload'), {
            onError: (errors) => {
                console.log(errors);
            },
        });
    };

    const submitFile = (e) => {
        e.preventDefault();
        post(route('file.upload'), {
            onError: (errors) => {
                console.log(errors);
            },
        });
    };

    return (
        <>
            <form onSubmit={submit}>
                <input
                    type="file"
                    onChange={(e) => setData('avatar', e.target.files[0])}
                />
                {errors.avatar && <div>{errors.avatar}</div>}
                {progress && <div>{progress.percentage}</div>}

                <button disabled={processing}>Upload Image</button>
                {avatar && (
                    <div style={{ marginTop: 20 }}>
                        <img src={avatar} alt="Upload" width={300} />
                    </div>
                )}
            </form>
            <br />
            <br />
            <form onSubmit={submitFile}>
                <input
                    type="file"
                    onChange={(e) => setData('file', e.target.files[0])}
                />
                {errors.file && <div>{errors.file}</div>}
                {progress && <div>{progress.percentage}</div>}

                <button disabled={processing}>Upload File</button>
                {file && (
                    <div style={{ marginTop: 20 }}>
                        <p>{file}</p>
                    </div>
                )}
            </form>
        </>
    );
}
